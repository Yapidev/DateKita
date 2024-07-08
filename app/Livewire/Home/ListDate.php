<?php

namespace App\Livewire\Home;

use App\Models\Date;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ListDate extends Component
{
    public int $date_id;
    public $dates;
    public array $classes;

    public function mount()
    {
        $this->dates = Date::query()
            ->orderByDesc('date_time')
            ->get();

        $this->classes = [
            'note-important',
            'note-social',
            'note-business'
        ];
    }

    #[On('new-date-created')]
    #[On('new-date-updated')]
    public function render()
    {
        return view(
            'livewire.home.list-date'
        );
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
