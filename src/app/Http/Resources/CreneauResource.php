<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreneauResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'heure_debut' => $this->heure_debut,
            'heure_fin' => $this->heure_fin,
            'jour_semaine' => $this->jour_semaine,
        ];
    }
}
