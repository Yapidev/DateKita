<?php

namespace App\Livewire\MyExpense;

use Livewire\Component;

class TableExpense extends Component
{
    public $user;
    public $expenses;

    public function mount($user)
    {
        $this->expenses = $user->expenses()->latest()->get();
    }

    public function render()
    {
        return view('livewire.my-expense.table-expense');
    }
}
