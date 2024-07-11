<?php

namespace App\Livewire\MyExpense;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Header extends Component
{
    public $user;

    #[Validate('required', message: 'Target pengeluaran harus di isi')]
    public $target_expense;

    public function mount($user)
    {
        $this->target_expense = $user->target_expenses;
    }

    public function render()
    {
        return view('livewire.my-expense.header');
    }

    public function addTargetExpense()
    {
        $this->validateOnly('target_expense');

        $this->user->update(['target_expenses' => $this->target_expense]);

        $this->dispatch('close-modal');

        if ($this->user->wasChanged()) {
            $this->notify('Berhasil', 'Berhasil mengisi target', 'success');
        } else {
            $this->notify('Info', 'Tidak ada perubahan', 'info');
        }
    }

    private function notify(string $title, string $message, string $icon)
    {
        $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }
}
