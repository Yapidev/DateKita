<?php

namespace App\Livewire\Home;

use App\Models\Date;
use App\Traits\GetGreeting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    use GetGreeting;

    public $user, $date_time, $location, $description;

    public function mount()
    {
        $this->user = Auth::user();
    }

    protected $rules = [
        'date_time' => 'required|date',
        'location' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'date_time.required' => 'Tanggal dan waktu harus diisi.',
        'date_time.date' => 'Tanggal dan waktu tidak valid.',
        'location.required' => 'Lokasi harus diisi.',
        'location.string' => 'Lokasi harus berupa teks.',
        'location.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
        'description.string' => 'Deskripsi harus berupa teks.',
        'description.max' => 'Deskripsi tidak boleh lebih dari 1000 karakter.',
    ];

    /**
     * Fungsi untuk render view
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.home.header', [
            'user' => $this->user,
            'greeting' => $this->getGreeting($this->user)
        ]);
    }

    public function addDate()
    {
        // Validasi data
        $validatedData = $this->validate();

        // Simpan data yang divalidasi ke database
        $newDate = Date::create($validatedData);

        // Tambah relasi
        $newDate->user()->syncWithoutDetaching([1, 2]);

        // Reset Modal
        $this->resetModal();

        // Kirim notifikasi alert
        $this->notify('Berhasil', 'Berhasil membuat date baru!', 'success');

        // Kirim event kencan baru telah dibuat
        $this->dispatch('new-date-created');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }

    public function resetModal()
    {
        $this->reset('date_time', 'location', 'description');

        $this->resetValidation();

        $this->dispatch('close-modal')->self();
    }
}
