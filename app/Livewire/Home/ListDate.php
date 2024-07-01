<?php

namespace App\Livewire\Home;

use App\Models\Date;
use Livewire\Attributes\On;
use Livewire\Component;

class ListDate extends Component
{
    #[On('new-date-created')]
    public function render()
    {
        $dates = Date::getAllDatesOrderedByDateTime();
        $classes = ['note-important', 'note-social', 'note-business'];

        return view('livewire.home.list-date', [
            'dates' => $dates,
            'classes' => $classes
        ]);
    }
}
