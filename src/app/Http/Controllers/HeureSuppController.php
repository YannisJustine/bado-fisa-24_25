<?php

namespace App\Http\Controllers;

use App\Models\TypePermis ;
use App\Http\Requests\AddOvertimeHourRequest;
use Illuminate\Support\Facades\Auth;

class HeureSuppController extends Controller
{

    public function index()
    {
        return view("catalogue.heures_supp.index");
    }

    /*
        Affiche le formulaire d'achat d'heures supplémentaires pour un type de permis
    */
    public function show(TypePermis $typePermis)
    {
        return view("catalogue.heures_supp.permis", compact('typePermis'));
    }

    /*
        Gère l'achat d'une heure supplémentaire
    */
    public function store(AddOvertimeHourRequest $request)
    {
        $validated = $request->validated();

        $candidat = Auth::guard('candidat')->user();
        $permis = TypePermis::find($validated['permis_id']);

        if (!$candidat || !$permis) {
            return redirect()->back()->with('error', 'Candidat ou type de permis non trouvé.');
        }

        $candidat->achatHeuresSupplementaires()->create([
            'type_permis_id' => $permis->id,
            'date_achat' => now(),
            'quantite' => $validated['quantite']
        ]);

        // Si le candidat n'a pas de stock d'heures supplémentaires pour ce permis, on en crée un sinon on met à jour le stock

        if ($candidat->stockHeuresSupplementaires()->where('type_permis_id', $permis->id)->doesntExist()) {
            $candidat->stockHeuresSupplementaires()->create([
                'type_permis_id' => $permis->id,
                'quantite_restante' => $validated['quantite']
            ]);
        } else {
            $stock = $candidat->stockHeuresSupplementaires()->where('type_permis_id', $permis->id)->first();
            $stock->update([
                'quantite_restante' => $stock->quantite_restante + $validated['quantite']
            ]);
        }

        return redirect()->route('catalogue.heures_supp')->with('success','L\'achat de '.$validated['quantite'].' heure(s) supplémentaire(s) pour le permis "'.$permis->libelle.'" a bien été effectué');
    }

}
