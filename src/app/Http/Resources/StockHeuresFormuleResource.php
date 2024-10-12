<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockHeuresFormuleResource extends JsonResource
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
            'formule_conduite_id' => $this->formule_conduite_id,
            'quantite_conduite_restante' => $this->quantite_conduite_restante,
            'quantite_pedagogique_restante' => $this->quantite_pedagogique_restante,
        ];
    }
}
