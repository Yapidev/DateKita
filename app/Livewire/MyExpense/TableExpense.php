<?php

namespace App\Livewire\MyExpense;

use Livewire\Component;
use Livewire\WithPagination;

class TableExpense extends Component
{
    use WithPagination;

    public $user;

    public function getExpenses($user)
    {
        $expenses = $user->expenses()
            ->with('date')
            ->latest()
            ->paginate(10);

        return $expenses;
    }

    public function render()
    {
        $expenses = $this->getExpenses($this->user);
        return view('livewire.my-expense.table-expense', [
            'expenses' => $expenses
        ]);
    }
}
