<?php

namespace App\Livewire\MyExpense;

use Livewire\Attributes\On;
use Livewire\Component;

class DetailExpense extends Component
{
    public $user;
    public $currentMonthExpense;
    public $targetExpense;
    public $difference;
    public $differenceFormatted;
    public $percentage;
    public $color;

    #[On('target-expense-updated')]
    public function render()
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

        return view('livewire.my-expense.detail-expense');
    }
}
