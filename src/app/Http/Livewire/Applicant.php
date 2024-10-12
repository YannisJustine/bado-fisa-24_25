<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Candidat;
use App\Traits\Livewire\WithSearchBar;
use Livewire\WithPagination;

class Applicant extends Component
{
    use WithPagination, WithSearchBar;

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
        // $faker = Factory::create();
        $candidats = Candidat::whereLike(['nom', 'prenom', 'email'], $this->searchField ?? '')->paginate(5);

        return view('livewire.candidats', ['candidats' => $candidats])
            ->extends('layouts.livewire', ['title' => 'Liste des candidats'])
            ->section('content');
    }
}
