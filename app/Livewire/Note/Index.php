<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public int $perPage = 9;
    public $filter = 'all';
    public $search = '';

    public function loadMore()
    {
        $this->perPage += 9;
    }

    #[On('comment-stored')]
    public function render()
    {
        // Mengambil catatan dengan semua relasi dan penghitungan yang diperlukan
        $notesQuery = Note::query()
            ->with(['author', 'favorites', 'comments.user'])
            ->withCount(['favorites', 'comments'])
            ->latest();

        // Menambahkan filter
        if ($this->filter == 'favorite') {
            $notesQuery->whereHas('favorites', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }

        // Menambahkan pencarian
        if ($this->search && $this->filter != 'favorite') {
            $notesQuery->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        } elseif ($this->search && $this->filter == 'favorite') {
            $search = $this->search;
            $notesQuery->whereHas('favorites', function ($query) use ($search) {
                $query->where('user_id', auth()->id())
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        };

        // Mengambil jumlah total catatan
        $notesCount = Note::count();

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
