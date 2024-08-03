<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentModal extends Component
{
    // Judul modal yang akan ditampilkan
    public $modal_title;

    // Objek Note yang akan diberi komentar
    public $note;

    // Isi komentar yang diinputkan oleh pengguna
    #[Validate('required', message: 'Komentar harus di isi')]
    public $content;

    // Render view untuk komponen Livewire
    public function render()
    {
        return view('livewire.note.comment-modal');
    }

    // Event listener untuk menambah komentar
    #[On('add-comment')]
    public function addComment(Note $note)
    {
        // Set note yang akan dikomentari
        $this->note = $note;

        // Set judul modal dengan informasi note
        $this->modal_title = 'Komentar dari note berjudul ' . $note->title;

        // Dispatch event untuk membuka modal
        $this->dispatch('open-modal')->self();
    }

    // Method untuk menyimpan komentar
    public function store()
    {
        // Validasi input komentar
        $data = $this->validate();

        // Set user_id dari pengguna yang saat ini sedang login
        $data['user_id'] = auth()->id();

        // Simpan komentar ke dalam note terkait
        $this->note->comments()->create($data);

        // Reset isi komentar setelah disimpan
        $this->reset('content');

        // Dispatch event setelah komentar berhasil disimpan
        $this->dispatch('comment-stored');
    }
}
