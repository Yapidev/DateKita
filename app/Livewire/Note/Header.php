<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Header extends Component
{
    public $modal_title;

    public Note $note;

    #[Validate('required', message: 'Judul note harus di isi')]
    public $title;

    #[Validate('required', message: 'Deskripsi note harus di isi')]
    public $description;

    public function render()
    {
        return view('livewire.note.header');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }

    public function create()
    {
        $this->reset();
        $this->modal_title = 'Tambah Note';
        $this->dispatch('open-modal')->self();
    }

    public function store()
    {
        $data = $this->validate();

        auth()->user()->notes()->create($data);

        $this->dispatch('close-modal');

        $this->reset();

        $this->notify('Berhasil', 'Berhasil menambah note', 'success');

        $this->dispatch('saved');
    }

    #[On('edit-note')]
    public function edit(Note $note)
    {
        $this->modal_title = "Edit Note berjudul " . $note->title;

        $this->note = $note;

        $this->title = $note->title;

        $this->description = $note->description;

        $this->dispatch('open-modal');
    }

    public function update(Note $note)
    {
        $data = $this->validate();

        $data['user_id'] = auth()->id();

        $note->update($data);

        $this->reset();

        $this->dispatch('close-modal');

        $this->dispatch('saved');

        $this->notify('Berhasil', 'Berhasil mengedit note', 'success');
    }

    #[On('delete-note')]
    public function delete(Note $note)
    {
        $note->delete();

        $note->favorites()->delete();

        $this->dispatch('close-modal');

        $this->dispatch('saved');

        $this->notify('Berhasil', 'Berhasil menghapus note', 'success');
    }
}
