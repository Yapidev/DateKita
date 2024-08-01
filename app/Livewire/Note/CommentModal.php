<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentModal extends Component
{
    public $modal_title;

    public $note;

    #[Validate('required', message: 'Komentar harus di isi')]
    public $content;

    public function render()
    {
        return view('livewire.note.comment-modal');
    }

    #[On('add-comment')]
    public function addComment(Note $note)
    {
        $this->note = $note;

        $this->modal_title = 'Komentar dari note berjudul ' . $note->title;

        $this->dispatch('open-modal')->self();
    }

    public function store()
    {
        $data = $this->validate();

        $data['user_id'] = auth()->id();

        $this->note->comments()->create($data);

        $this->reset('content');

        $this->dispatch('comment-stored');
    }
}
