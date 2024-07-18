<?php

namespace App\Livewire\MyExpense;

use Livewire\Component;
use Livewire\WithPagination;

class TableExpense extends Component
{
    use WithPagination;

    public $user;
    public $expenses;

    public function mount($user)
    {
        $this->expenses = $user->expenses()
            ->with('date')
            ->orderByDesc('date_time')
            ->paginate(1);
    }

    public function render()
    {
        return view('livewire.my-expense.table-expense');
    }
}
