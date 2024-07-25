<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class ListNote extends Component
{
    #[Reactive]
    public $notes;
    public array $classes;

    public function mount()
    {
        $this->classes = [
            'note-important',
            'note-social',
            'note-business'
        ];
    }

    public function render()
    {
        return view('livewire.note.list-note');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }

    public function toggleFavorite(Note $note)
    {
        $user = auth()->user();

        $favorite = $note->favorites()->where('user_id', $user->id)->first();

        if ($favorite) {
            $favorite->delete();

            $this->notify('Berhasil', 'Berhasil menghapus favorit', 'success');
        } else {
            $note->favorites()->create([
                'user_id' => $user->id
            ]);

            $this->notify('Berhasil', 'Berhasil menambahkan favorit', 'success');
        }

        $this->dispatch('saved');
    }
}
