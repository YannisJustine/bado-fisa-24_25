<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dateReservation = $this->date_reservation->format('Y-m-d');
        $start = $dateReservation . ' ' . $this->heure_debut;
        $end = $dateReservation . ' ' . $this->heure_fin;

        $title = $this->leconConduite !== null ? 'Cours de conduite' : ($this->leconAccompagnement !== null ? 'Cours d\'accompagnement' : '');
 
        return [
            'id' => $this->id,
            'formateur_id' => $this->user_id,
            'candidat_id' => $this->candidat_id,
            'date_reservation' => $dateReservation,
            'start' => $start,
            'end' => $end,
            'statut_id' => $this->statut_id,
            'title' => $title,
            'conduite' => $this->when($this->leconConduite !== null, true),
            'accompagnement' => $this->when($this->leconAccompagnement !== null, true),
            'color' => $this->getColor(),
            'textColor' => '#000000', //TODO peut etre changer la couleur du texte en fonction de la couleur de fond
        ];
    }

    private function getColor() {
        $statutValide = $this->statut_id === 3;
        $statutEnAttente = $this->statut_id === 0;
        $LeconConduite = $this->leconConduite !== null;
        $LeconAccompagnement = $this->leconAccompagnement !== null;
    
        if ($statutValide && $LeconConduite) {
            return '#00CC00';
        } elseif ($LeconConduite && $statutEnAttente) {
            return '#FCDC12';
        } elseif ($statutValide && $LeconAccompagnement) {
            return '#00B700';
        } elseif ($LeconAccompagnement && $statutEnAttente) {
            return '#FFFF00';
        } else {
            return '#CC0000'; // Couleur par défaut
        }
    }
}

