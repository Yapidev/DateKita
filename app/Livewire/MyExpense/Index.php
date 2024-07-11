<?php

namespace App\Livewire\MyExpense;

use Livewire\Component;

class Index extends Component
{
    public $user;
    public $currentMonthExpense;

    public function mount($user)
    {
        $this->currentMonthExpense = $user->getCurrentMonthExpense();
    }

    public function render()
    {
        return view('livewire.my-expense.index');
    }
}
