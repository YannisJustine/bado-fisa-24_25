<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StockHeuresSupplementaireCollection;

class CandidatResource extends JsonResource
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
            'adresse' => $this->adresse,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'age' => $this->age,   
            'formules_conduite' => new FormuleConduiteCollection($this->whenLoaded('conduites')), 
            'formules_code' => new FormuleCodeCollection($this->whenLoaded('codes')), 
            'stock_heures_supplementaire' => new StockHeuresSupplementaireCollection($this->whenLoaded('stockHeuresSupplementaires')),   
            'stock_heures_formule' => new StockHeuresFormuleCollection($this->whenLoaded('stockHeuresFormule')),    
        ];
    }
}
