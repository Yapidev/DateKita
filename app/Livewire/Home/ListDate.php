<?php

namespace App\Livewire\Home;

use App\Models\Date;
use Livewire\Attributes\On;
use Livewire\Component;

class ListDate extends Component
{
    public array $classes;
    public int $perPage = 3;

    public function mount()
    {
        $this->classes = [
            'note-important',
            'note-social',
            'note-business'
        ];
    }

    public function loadMore()
    {
        $this->perPage += 3;
    }

    #[On('new-date-created')]
    #[On('new-date-updated')]
    public function render()
    {
        $dates = Date::query()
            ->orderByDesc('date_time')
            ->take($this->perPage)
            ->get();

        return view('livewire.home.list-date', [
            'dates' => $dates
        ]);
    }

    public function deleteDate(Date $date)
    {
        $date->delete();

        $this->notify('Berhasil', 'Berhasil menghapus Kencan', 'success');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }
}
