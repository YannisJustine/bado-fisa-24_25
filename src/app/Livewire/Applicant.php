<?php

namespace App\Livewire;

use Faker\Factory;
use Livewire\Component;
use App\Models\Candidat;
use Livewire\Attributes\On;
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
        // $candidats = [];
        // for($i = 0; $i < 10; $i++) {
        //     $candidats[] = [
        //         'nom' => $faker->name(),
        //     ];
        // }

        return view('livewire.applicant', ['candidats' => $candidats])
            ->extends('layouts.livewire')
            ->section('content');
    }
}
