<?php

namespace App\Livewire\MyExpense;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailExpense extends Component
{
    public User $user;
    public $currentMonthExpense;
    public $targetExpense;
    public $difference;
    public $differenceFormatted;
    public $percentage;
    public $color;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function calcuteExpenses()
    {
        $this->currentMonthExpense = $this->user->getCurrentMonthExpense();
        $this->targetExpense = $this->user->target_expenses;

        $this->difference = $this->targetExpense - $this->currentMonthExpense;
        $this->differenceFormatted = number_format(abs($this->difference), 0, ',', '.');

        if ($this->targetExpense > 0) {
            $this->percentage = ($this->currentMonthExpense / $this->targetExpense) * 100;
        } else {
            $this->percentage = 0;
        }

        if ($this->percentage > 100) {
            $this->color = 'text-danger';
        } else if ($this->percentage >= 50) {
            $this->color = 'text-warning';
        } else {
            $this->color = 'text-success';
        }
    }

    #[On('target-expense-updated')]
    public function render()
    {
        $this->calcuteExpenses();
        
        return view('livewire.my-expense.detail-expense');
    }
}
