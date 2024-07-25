<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public int $perPage = 9;

    public function loadMore()
    {
        $this->perPage += 9;
    }

    public function render()
    {
        $notes = Note::withFavoritesFirst()
            ->with(['author', 'favorites'])
            ->latest()
            ->take($this->perPage)
            ->get();

        $notesCount = Note::count();

        return view('livewire.note.index', [
            'notes' => $notes,
            'notesCount' => $notesCount
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
