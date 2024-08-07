<?php

namespace App\Livewire\Note;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class Filter extends Component
{
    #[Modelable]
    public $value = 'all';

    public function render()
    {
        return view('livewire.note.filter');
    }
}
