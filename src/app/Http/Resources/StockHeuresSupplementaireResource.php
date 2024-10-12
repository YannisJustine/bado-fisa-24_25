<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockHeuresSupplementaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'candidat_id' => $this->candidat_id,
            'type_permis_id' => $this->type_permis_id,
            'quantite_restante' => $this->quantite_restante,
        ];
    }
}
