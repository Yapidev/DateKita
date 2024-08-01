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
        // Mengambil catatan dengan semua relasi dan penghitungan yang diperlukan
        $notesQuery = Note::query()
            ->with(['author', 'favorites', 'comments.user'])
            ->withCount('favorites')
            ->latest();

        // Mengambil jumlah total catatan
        $notesCount = $notesQuery->count();

        // Mengambil catatan sesuai dengan jumlah per halaman dan menambahkan atribut is_favorited
        $notes = $notesQuery->take($this->perPage)
            ->get()
            ->map(function ($note) {
                $note->is_favorited = $note->favorites->contains('user_id', auth()->id());
                return $note;
            });

        // Mengembalikan view dengan data catatan dan jumlah catatan
        return view('livewire.note.index', [
            'notes' => $notes,
            'notesCount' => $notesCount
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
