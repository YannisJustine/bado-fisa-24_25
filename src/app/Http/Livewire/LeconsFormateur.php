<?php

namespace App\Http\Livewire;

use App\Services\LessonService;
use App\Models\Lecon;
use Livewire\Component;
use App\Enums\StatutEnum;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class LeconsFormateur extends Component
{
    use WithPagination;

    public Lecon $currentLecon;
    public $dateOrder = true;
    public $count = 0;
    public $openModal = false;

    public function close()
    {
        $this->openModal = false;
    }

    public function open()
    {
        $this->openModal = true;
    }

    public function switchDateOrder()
    {
        $this->dateOrder = !$this->dateOrder;
        $this->resetPage();
    }

    public function render()
    {
        $lecons = Auth::user()->lecons()->with(['statut', 'candidat'])->orderBy("date_reservation", $this->dateOrder ? "asc": "desc")->orderBy("id")->paginate(10);
        return view('livewire.lecons-formateur', compact('lecons'));
    }

    // Refuse une leçon et recherche un autre formateur la première fois
    public function deny(Lecon $lecon, LessonService $lessonService)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $lessonService->deny($lecon);
    }

    // Fonction appelée lors de la validation d'une leçon dans le tableau
    public function tryAccept(Lecon $lecon, LessonService $lessonService)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!$lessonService->checkUserAvailability($lecon))
            return $lessonService->deny($lecon);
    
        if(!$lessonService->checkVehiculeAvailability($lecon))
            return $lessonService->changeStatus($lecon, StatutEnum::IMPOSSIBLE);
        
        $others = $lessonService->getLessonsIntersection($lecon, [["statut_id", "=", StatutEnum::ATTENTE], ["user_id", "=", $lecon->user_id]]);

        if (count($others) > 0) {
            $this->currentLecon = $lecon;
            $this->count = count($others);
            $this->openModal = true;
        } else {
            $lessonService->accept($lecon);
        }
    }

    // Fonction appelée lors de la validation d'une leçon dans le modal
    public function validateCurrentLecon(LessonService $lessonService)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!$lessonService->checkUserAvailability($this->currentLecon))
            $lessonService->deny($this->currentLecon);
        else {
            if(!$lessonService->checkVehiculeAvailability($this->currentLecon))
                $lessonService->changeStatus($this->currentLecon, StatutEnum::IMPOSSIBLE);
            else {
                $lessonService->accept($this->currentLecon);
            }
        }
        
        $this->close();
    }

}
