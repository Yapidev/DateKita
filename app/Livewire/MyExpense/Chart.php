<?php

namespace App\Livewire\MyExpense;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $monthlyExpenses = [];
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
        $this->calculateMonthlyExpenses();
    }

    public function calculateMonthlyExpenses()
    {
        $expenses = $this->user->expenses()
            ->select(DB::raw('SUM(expenses.amount) as total, MONTH(date.date_time) as month, YEAR(date.date_time) as year'))
            ->join('dates', 'expenses.date_id', '=', 'date.id')
            ->whereYear('dates.date_time', Carbon::now()->year)
            ->groupBy(DB::raw('YEAR(dates.date_time), MONTH(dates.date_time)'))
            ->get();

        // Initialize all months with 0
        $this->monthlyExpenses = array_fill(1, 12, 0);

        foreach ($expenses as $expense) {
            $this->monthlyExpenses[$expense->month] = $expense->total;
        }
    }

    public function render()
    {
        return view('livewire.my-expense.chart');
    }
}
