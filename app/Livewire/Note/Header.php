<?php

namespace App\Livewire\Note;

use App\Models\Note;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Header extends Component
{
    // Judul modal yang akan ditampilkan
    public $modal_title;

    // Objek Note yang sedang diproses
    public Note $note;

    // Tanggal pembuatan note, harus diisi
    #[Validate('required', message: 'Tanggal harus di isi')]
    public $created_at;

    // Judul note, harus diisi
    #[Validate('required', message: 'Judul note harus di isi')]
    public $title;

    // Deskripsi note, harus diisi
    #[Validate('required', message: 'Deskripsi note harus di isi')]
    public $description;

    // Render view untuk komponen Livewire
    public function render()
    {
        // Mengembalikan tampilan untuk komponen Livewire
        return view('livewire.note.header');
    }

    // Method untuk mengirim notifikasi
    public function notify(string $title, string $message, string $icon)
    {
        // Mengirimkan notifikasi dengan judul, pesan, dan ikon tertentu
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }

    // Method untuk membuka modal penambahan note baru
    public function create()
    {
        // Mereset properti komponen
        $this->reset();

        // Mereset validasi form
        $this->resetValidation();

        // Mengatur tanggal saat ini sebagai tanggal pembuatan note
        $this->created_at = Carbon::now()->format('Y-m-d');

        // Mengatur judul modal
        $this->modal_title = 'Tambah Note';

        // Mengirimkan event untuk membuka modal
        $this->dispatch('open-modal')->self();
    }

    // Method untuk menyimpan note baru
    public function store()
    {
        // Validasi data input
        $data = $this->validate();

        // Mengubah tanggal yang diinput menjadi format timestamp
        $data['created_at'] = Carbon::createFromFormat('Y-m-d', $this->created_at)->timestamp;

        // Menyimpan note baru ke database untuk pengguna yang sedang login
        auth()->user()->notes()->create($data);

        // Mengirimkan event untuk menutup modal
        $this->dispatch('close-modal');

        // Mereset properti komponen
        $this->reset();

        // Mengirimkan notifikasi sukses
        $this->notify('Berhasil', 'Berhasil menambah note', 'success');

        // Mengirimkan event bahwa data telah disimpan
        $this->dispatch('saved');
    }

    // Event listener untuk mengedit note
    #[On('edit-note')]
    public function edit(Note $note)
    {
        // Mereset validasi form
        $this->resetValidation();

        // Mengatur judul modal untuk mode edit
        $this->modal_title = "Edit Note berjudul " . $note->title;

        // Mengisi properti dengan data note yang akan diedit
        $this->created_at = $note->created_at->format('Y-m-d');
        $this->note = $note;
        $this->title = $note->title;
        $this->description = $note->description;

        // Mengirimkan event untuk membuka modal
        $this->dispatch('open-modal');
    }

    // Method untuk mengupdate note yang ada
    public function update(Note $note)
    {
        // Validasi data input
        $data = $this->validate();

        // Set user_id dari pengguna yang sedang login
        $data['user_id'] = auth()->id();

        // Mengubah tanggal yang diinput menjadi format timestamp
        $data['created_at'] = Carbon::createFromFormat('Y-m-d', $this->created_at)->timestamp;

        // Update note yang ada di database
        $note->update($data);

        // Mereset properti komponen
        $this->reset();

        // Mengirimkan event untuk menutup modal
        $this->dispatch('close-modal');

        // Mengirimkan event bahwa data telah disimpan
        $this->dispatch('saved');

        // Mengirimkan notifikasi sukses
        $this->notify('Berhasil', 'Berhasil mengedit note', 'success');
    }

    // Event listener untuk menghapus note
    #[On('delete-note')]
    public function delete(Note $note)
    {
        // Menghapus note dari database
        $note->delete();

        // Menghapus favorit terkait dari note yang dihapus
        $note->favorites()->delete();

        // Mengirimkan event untuk menutup modal
        $this->dispatch('close-modal');

        // Mengirimkan event bahwa data telah dihapus
        $this->dispatch('saved');

        // Mengirimkan notifikasi sukses
        $this->notify('Berhasil', 'Berhasil menghapus note', 'success');
    }
}
