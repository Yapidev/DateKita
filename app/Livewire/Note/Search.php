<?php

namespace App\Livewire\Note;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class Search extends Component
{
    #[Modelable]
    public $value = '';

    public function render()
    {
        return view('livewire.note.search');
    }
}
