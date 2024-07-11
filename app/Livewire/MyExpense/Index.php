<?php

namespace App\Livewire\MyExpense;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $user;
    public $currentMonthExpense;

    public function mount($user)
    {
        $this->currentMonthExpense = $user->getCurrentMonthExpense();
    }

    #[On('target-expense-updated')]
    public function render()
    {
        return view('livewire.my-expense.index');
    }
}
