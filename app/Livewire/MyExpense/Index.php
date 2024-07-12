<?php

namespace App\Livewire\MyExpense;

use Livewire\Component;

class Index extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.my-expense.index');
    }
}
