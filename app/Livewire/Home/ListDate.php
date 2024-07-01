<?php

namespace App\Livewire\Home;

use App\Models\Date;
use Livewire\Attributes\On;
use Livewire\Component;

class ListDate extends Component
{
    public $date_id;

    #[On('new-date-created')]
    #[On('new-date-updated')]
    public function render()
    {
        $dates = Date::getAllDatesOrderedByDateTime();
        $classes = ['note-important', 'note-social', 'note-business'];

        return view('livewire.home.list-date', [
            'dates' => $dates,
            'classes' => $classes
        ]);
    }

    public function deleteDate($date_id)
    {
        Date::findOrFail($date_id)->delete();

        $this->notify('Berhasil', 'Berhasil menghapus Kencan', 'success');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }
}
