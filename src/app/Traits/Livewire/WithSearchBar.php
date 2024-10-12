<?php

namespace App\Traits\Livewire;

trait WithSearchBar
{
    public $searchField;

    public function dispatchSearch() {

        $this->searchField = trim($this->searchField);
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

}
