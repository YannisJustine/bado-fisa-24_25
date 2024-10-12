<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormuleConduiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "formule_id" => $this->formule_id,
            "type_permis_id" => $this->type_permis_id,
            "age_requis" => $this->age_requis,
            "nb_heures_conduite" => $this->nb_heures_conduite,
            "nb_heures_pedagogique" => $this->nb_heures_pedagogique, 
        ];
    }
}
