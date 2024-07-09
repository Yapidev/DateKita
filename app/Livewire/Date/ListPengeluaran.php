<?php

namespace App\Livewire\Date;

use App\Models\Expense;
use Livewire\Component;

class ListPengeluaran extends Component
{
    public $expense;

    public function render()
    {
        return view('livewire.date.list-pengeluaran');
    }

    public function deleteExpense(int $expense_id)
    {
        Expense::findOrFail($expense_id)->delete();

        $this->dispatch('expense-deleted');

        return $this->dispatch('notify', title: 'Berhasil', message: 'Berhasil menghapus pengeluaran', icon: 'success')->self();

    }

    public function editExpense(int $expense_id)
    {
        $this->dispatch('edit-expense', expense_id: $expense_id);
    }

    public function deleteConfirmation(int $expense_id)
    {
        $this->dispatch('delete-confirmation', title: 'Apakah anda yakin?', message: 'Data tidak bisa di kembalikan', expense_id: $expense_id);
    }
}
