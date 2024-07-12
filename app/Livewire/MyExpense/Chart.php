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
            ->select(DB::raw('SUM(amount) as total, MONTH(created_at) as month'))
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
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
