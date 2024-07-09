<?php

namespace App\Livewire\Date;

use App\Models\Date;
use App\Models\Expense;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public Date $date;
    public $description;
    public $amount;
    public $paid_by;
    public $modal_title;
    public $expense_id;
    public $card_color;
    public $title;

    protected $rules = [
        'title' => 'required|string',
        'amount' => 'required|numeric|min:0',
        'description' => 'required|string',
        'paid_by' => 'required',
    ];

    protected $messages = [
        'title.required' => 'Judul harus diisi.',
        'title.string' => 'Judul harus berupa teks.',
        'amount.required' => 'Jumlah harus diisi.',
        'amount.numeric' => 'Jumlah harus berupa angka.',
        'amount.min' => 'Jumlah harus lebih besar atau sama dengan 0.',
        'description.required' => 'Deskripsi harus diisi.',
        'description.string' => 'Deskripsi harus berupa teks.',
        'paid_by.required' => 'Pembayar harus diisi.',
    ];

    public function render()
    {
        $users = User::query()->get();
        return view('livewire.date.header', [
            'users' => $users
        ]);
    }

    public function addExpense()
    {
        $this->resetModal();

        $this->modal_title = 'Tambah Pengeluaran';

        $this->openModal();
    }

    public function storeExpense()
    {
        $validatedData = $this->validate();

        $validatedData['date_id'] = $this->date->id;

        if ($this->card_color == null) {
            $this->card_color = 'primary';
        }

        $validatedData['card_header_color'] = $this->card_color;

        Expense::create($validatedData);

        // Tutup modal
        $this->closeModal();

        // Reset Modal
        $this->resetModal();

        // Kirim notifikasi alert
        $this->notify('Berhasil', 'Berhasil membuat pengeluaran baru!', 'success');

        // Kirim event kencan baru telah dibuat
        $this->dispatch('new-expense-created');
    }

    #[On('edit-expense')]
    public function editExpense(int $expense_id)
    {
        $this->resetModal();

        $this->expense_id = $expense_id;

        $expense = Expense::findOrFail($expense_id);

        $this->title = $expense->title;
        $this->amount = $expense->amount;
        $this->description = $expense->description;
        $this->paid_by = $expense->paid_by;
        $this->card_color = $expense->card_header_color;

        $this->modal_title = 'Edit Pengeluaran';

        $this->openModal();
    }

    public function updateExpense(int $expense_id)
    {
        $validatedData = $this->validate();

        $validatedData['card_header_color'] = $this->card_color;

        Expense::findOrFail($expense_id)->update($validatedData);

        $this->dispatch('new-expense-updated');

        $this->closeModal();

        $this->resetModal();

        $this->notify('Berhasil', 'Berhasil mengedit pengeluaran!', 'success');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }

    public function resetModal()
    {
        $this->reset('description', 'amount', 'paid_by', 'card_color', 'title');

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
