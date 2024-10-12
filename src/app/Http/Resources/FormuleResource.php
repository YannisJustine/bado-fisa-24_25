<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "libelle" => $this->libelle,
            "prix" => $this->prix,
            "type_permis" => $this->whenNotNull($this->whenLoaded('formuleConduite', function () {
                return $this->formuleConduite->typePermis;
            })),
        ];
    }
}
