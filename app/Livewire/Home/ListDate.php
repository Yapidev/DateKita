<?php

namespace App\Livewire\Home;

use App\Models\Date;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ListDate extends Component
{
    public array $classes;
    public int $perPage = 9;

    #[Url('search')]
    public string $search = '';

    #[Url('filter')]
    public string $filter = 'latest';

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
        $this->perPage += 9;
    }

    #[On('new-date-created')]
    #[On('new-date-updated')]
    public function render()
    {
        // start query
        $dates = Date::query()
            ->with('ratings');

        // Menambahkan filter
        if ($this->filter == 'latest') {
            $dates->orderByDesc('date_time');
        } elseif ($this->filter == 'oldest') {
            $dates->orderBy('date_time');
        }

        // Menambahkan pencarian
        if ($this->search) {
            $dates->where('location', 'like', '%' . $this->search . '%');
        }

        // Get data
        $dates = $dates->take($this->perPage)
            ->get();

        $datesCount = Date::count();

        return view('livewire.home.list-date', [
            'dates' => $dates,
            'datesCount' => $datesCount
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
