<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Lecon;
use App\Enums\StatutEnum;
use App\Events\EventAsked;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\EventService;
use Illuminate\Support\Carbon;
use App\Models\FormuleConduite;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;
use App\Http\Requests\Api\CreateEventRequest;
use App\Http\Requests\Api\UpdateEventRequest;

class EventController extends Controller
{
    private $eventService;
    private $userService;

    public function __construct(EventService $eventService, UserService $userService)
    {
        $this->eventService = $eventService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $conditions = [
            ["statut_id", '<>', StatutEnum::REFUSE->value],
            ["statut_id", '<>', StatutEnum::IMPOSSIBLE->value],
        ];
        if ($request->has('formateur_id')) {
            $conditions[] = ['user_id', $request->formateur_id];
        }
        if ($request->has('candidat_id')) {
            $conditions[] = ['candidat_id', $request->candidat_id];
        }
        if ($request->has('date_reservation')) {
            $conditions[] = ['date_reservation', $request->date_reservation];
        }
        if($request->has('start')) {
            $conditions[] = ["date_reservation", '>=', $request->start];
        }
        if($request->has('end')) {
            $conditions[] = ["date_reservation", '<=', $request->end];
        }

        $lecons = $this->eventService->getAllEvents($conditions);
        return new EventCollection($lecons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request): JsonResponse
    {
        $formateur = User::find($request->formateur_id);
        $candidatId = $request->candidat_id;
        $formuleId = $request->formule_id;
        $dateReservation = $request->date_reservation;
        $start = $request->start;
        $end = $request->end;
        $typeHeure = $request->type_heure;
        $typeHeureConduite = $request->type_heure_conduite;
        $nbrHeures = Carbon::parse($end)->diffInHours(Carbon::parse($start));

        $typePermisId = $request->type_permis_id
            ? $request->type_permis_id
            : FormuleConduite::where('formule_id', $formuleId)->first()->type_permis_id;

        if (!$this->userService->hasTypePermis($formateur->id, $typePermisId)) {
            return $this->eventService->error(422, ['formateur_id' => ['Le formateur ne possède pas ce type de permis']]);
        }

        $lecons = Lecon::where('user_id', $formateur->id)->where('statut_id', StatutEnum::PLANIFIE->value)->where('date_reservation', $dateReservation)->get();

        if (!$this->userService->hasContinuousIntervalForHour($start, $end, $formateur, Carbon::parse($dateReservation)->dayOfWeek) || !$this->userService->checkFormateurLeconAvailability($start, $end, $lecons)) {
            return $this->eventService->error(422, ['formateur_id' => ['Le formateur n\'est pas disponible à cette heure-ci']]);
        }

        if($this->eventService->hasIntersectHoursCandidat($candidatId, $dateReservation, $start, $end)) {
            return $this->eventService->error(422, ['candidat_id' => ['Le candidat a déjà une leçon à cette heure-ci']]);
        }

        $validationResult = $this->validateCandidat($candidatId, $formuleId, $typeHeureConduite, $typePermisId, $nbrHeures);

        if ($validationResult !== true) {
            return $validationResult;
        }

        if ($typeHeure == "accompagnement") {
            $lecon = $this->eventService->createLeconAccompagnement($formateur->id, $candidatId, $formuleId, $dateReservation, $start, $end);

            return response()->json([
                'event' => new EventResource($lecon),
            ], 201);
        }

        if (count($vehicules = $this->eventService->getAvailableVehicules($dateReservation, $start, $end, $typePermisId)) < 1) {
            return $this->eventService->error(422, ['vehicule' => ['Il n\'y a plus de véhicules disponible pour ce créneaux']]);
        }

        $vehicule = $vehicules->random();
        $lecon = $this->eventService->createLeconConduite($formateur->id, $candidatId, $formuleId, $dateReservation, $start, $end, $vehicule);
        try {
            EventAsked::dispatch($lecon);
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return response()->json([
            'event' => new EventResource($lecon),
        ], 201);
    }

    public function destroy(Lecon $lecon)
    {     
        if (!$lecon) {
            return $this->eventService->error(404, ['lecon_id' => ['La leçon n\'existe pas']]);
        }

        if ($lecon->statut_id != StatutEnum::ATTENTE->value) {
            return $this->eventService->error(422, ['lecon_id' => ['La leçon est déjà planifiée']]);
        }

        $lecon->delete();

        return response()->json([
            'message' => 'Leçon supprimée avec succès',
        ], 200);
    }

    public function update(Lecon $lecon, UpdateEventRequest $request)
    {
        if (!$lecon) {
            return $this->eventService->error(404, ['lecon_id' => ['La leçon n\'existe pas']]);
        }

        if ($lecon->statut_id !== StatutEnum::ATTENTE->value) {
            return $this->eventService->error(422, ['lecon_id' => ['La leçon est déjà planifiée']]);
        }

        $formateur = User::find($lecon->user_id);
        $dateArrive = $request->date_arrive;
        $start = $request->start;
        $end = $request->end;
        
        $lecons = Lecon::where('user_id', $formateur->id)->where('statut_id', StatutEnum::PLANIFIE->value)->where('date_reservation', $dateArrive)->get();

        if (!$this->userService->hasContinuousIntervalForHour($start, $end, $formateur, Carbon::parse($dateArrive)->dayOfWeek) || !$this->userService->checkFormateurLeconAvailability($start, $end, $lecons)) {
            return $this->eventService->error(422, ['formateur_id' => ['Le formateur n\'est pas disponible à cette heure-ci']]);
        }

        $lecon->update([
            'date_reservation' => $dateArrive,
            'heure_debut' => $start,
            'heure_fin' => $end,
        ]);

        return response()->json([
            'message' => 'Leçon modifiée avec succès',
        ], 200);
    }


    private function validateCandidat($candidatId, $formuleId, $typeHeureConduite, $typePermisId, $nbrHeuresRestantes)
    {
        if ($typeHeureConduite == "supplementaire") {
            if (!$this->eventService->hasCandidatHeureSupp($candidatId, $typePermisId)) {
                return $this->eventService->error(422, ['type_permis_id' => ['Le candidat n\'a pas d\'heures supplémentaires pour ce type de permis']]);
            }

            if ($this->eventService->getCandidatSuppRemainingHours($candidatId, $typePermisId) < $nbrHeuresRestantes) {
                return $this->eventService->error(422, ['type_permis_id' => ['Le candidat n\'a plus assez d\'heures disponible dans ses heures supplémentaires pour ce type de permis']]);
            }
        } else {
            if (!$this->eventService->hasFormule($candidatId, $formuleId)) {
                return $this->eventService->error(422, ['formule_id' => ['Le candidat n\'a jamais acheté cette formule']]);
            }
            if($typeHeureConduite) {
                if ($this->eventService->getCandidatFormuleRemainingHours($candidatId, $formuleId) < $nbrHeuresRestantes) {
                    return $this->eventService->error(422, ['formule_id' => ['Le candidat n\'a plus assez d\'heures disponible pour cette formule']]);
                }
            } else {
                if ($this->eventService->getCandidatFormuleRemainingHours($candidatId, $formuleId, false) < $nbrHeuresRestantes) {
                    return $this->eventService->error(422, ['formule_id' => ['Le candidat n\'a plus assez d\'heures d\'accompagnement disponible pour cette formule']]);
                }
            }
        }

        return true;
    }
}
