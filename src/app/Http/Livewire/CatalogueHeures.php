<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypePermis;
use App\Traits\Livewire\WithSearchBar;

class CatalogueHeures extends Component
{
    use WithSearchBar;

    protected function queryString()
    {
        return [
            'searchField' => [
                'as' => 'q',
            ]
        ];
    }

    /*
        Affiche la liste des types de permis
    */
    public function render()
    {
        $permis = TypePermis::whereLike(['libelle'], $this->searchField ?? '')->get();
           
        return view("livewire.catalogue.index-heures", compact('permis'));
    }
    
}
