<?php

namespace App\Livewire\Date;

use App\Models\Expense;
use Livewire\Attributes\On;
use Livewire\Component;

class ListPengeluaran extends Component
{
    public $expense;

    public function render()
    {
        return view('livewire.date.list-pengeluaran', [
            'expense' => $this->expense->sortByDesc('created_at')
        ]);
    }

    public function deleteExpense(int $expense_id)
    {
        Expense::findOrFail($expense_id)->delete();

        $this->dispatch('expense-deleted');

        $this->dispatch('notify', title: 'Berhasil', message: 'Berhasil menghapus pengeluaran', icon: 'success')->self();
    }
}
