<?php

namespace App\Livewire\Home;

use App\Models\Date;
use App\Traits\GetGreeting;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    use GetGreeting;

    public string $greeting;
    public mixed $user;
    public date $date_time;
    public string $location;
    public string $description;
    public string $modal_title;
    public int $date_id;

    public function mount()
    {
        $this->user = Auth::user();
        $this->greeting = $this->getGreeting($this->user);
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
     * @return View
     */
    public function render(): View
    {
        return view('livewire.home.header');
    }

    public function addDate()
    {
        $this->resetModal();

        $this->modal_title = 'Tambah Kencan';

        $this->openModal();
    }

    public function storeDate()
    {
        // Validasi data
        $validatedData = $this->validate();

        // Simpan data yang divalidasi ke database
        $newDate = Date::create($validatedData);

        // Tambah relasi
        $newDate->user()->syncWithoutDetaching([1, 2]);

        // Reset Modal
        $this->resetModal();

        $this->closeModal();

        // Kirim notifikasi alert
        $this->notify('Berhasil', 'Berhasil membuat date baru!', 'success');

        // Kirim event kencan baru telah dibuat
        $this->dispatch('new-date-created');
    }

    #[On('edit-date')]
    public function editDate($date_id)
    {
        $date = Date::findOrFail($date_id);

        $this->date_time = Carbon::parse($date->date_time)->format('Y-m-d');
        $this->location = $date->location;
        $this->description = $date->description;

        $this->date_id = $date_id;

        $this->modal_title = 'Edit Kencan';

        $this->openModal();
    }

    public function updateDate($date_id)
    {
        $validatedData = $this->validate();

        Date::findOrFail($date_id)->update($validatedData);

        $this->resetModal();

        $this->closeModal();

        $this->notify('Berhasil', 'Berhasil mengedit Kencan', 'success');

        $this->dispatch('new-date-updated');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }

    public function resetModal()
    {
        $this->reset('date_time', 'location', 'description', 'modal_title', 'date_id');

        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->dispatch('close-modal')->self();
    }

    public function openModal()
    {
        $this->dispatch('open-modal')->self();
    }
}
