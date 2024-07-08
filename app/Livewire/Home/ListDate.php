<?php

namespace App\Livewire\Home;

use App\Models\Date;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ListDate extends Component
{
    public int $date_id;
    public array $classes;

    public function mount()
    {
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
        $dates = Date::query()
            ->orderByDesc('date_time')
            ->get();

        return view('livewire.home.list-date', [
            'dates' => $dates
        ]);
    }

    public function deleteDate(int $date_id)
    {
        Date::destroy($date_id);

        $this->notify('Berhasil', 'Berhasil menghapus Kencan', 'success');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }
}
