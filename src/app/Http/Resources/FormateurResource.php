<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormateurResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'num_securite_sociale' => $this->num_securite_sociale,
            'creneaux' => $this->whenLoaded('creneaux', function () {
                return (new CreneauCollection($this->creneaux()->orderBy('jour_semaine')->get()))->collection->groupBy('jour_semaine');
            }),
            'type_permis' => $this->whenLoaded('typePermis'),
        ];
    }
}
