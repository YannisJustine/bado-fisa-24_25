<?php

namespace App\Http\Livewire;

use App\Models\Lecon;
use Livewire\Component;
use Livewire\WithPagination;

class CandidatLecons extends Component
{
    use WithPagination;

    public int $candidatId;

    public function mount($candidatId)
    {
        $this->candidatId = $candidatId;
    }

    public function render()
    {
        $lecons = Lecon::where('candidat_id', $this->candidatId)->with('statut')->orderBy("date_reservation", "asc")->orderBy("id")->paginate(10);
        return view('livewire.candidat-lecons', compact('lecons'));
    }
}
