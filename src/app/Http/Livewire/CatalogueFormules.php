<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Formule;
use App\Traits\Livewire\WithSearchBar;

class CatalogueFormules extends Component
{
    use WithSearchBar;

    public $formule_type = "";

    protected function queryString()
    {
        return [
            'searchField' => [
                'as' => 'q',
            ]
        ];
    }


    public function render()
    {
        $formules = Formule::whereLike(['libelle'], $this->searchField ?? '')->get()
            ->when($this->formule_type, function ($query) {
                return $query->filter(function ($formule) {
                    return $formule->getType() == $this->formule_type;
                });
            });
           
        return view("livewire.catalogue.index-formules", compact('formules'));
    }
    
}
