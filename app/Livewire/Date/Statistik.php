<?php

namespace App\Livewire\Date;

use App\Models\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Statistik extends Component
{
    public $date_id, $date;

    public function mount()
    {
        $this->date = Date::where('id', $this->date_id)->with('expenses', 'user')->first();
    }

    #[On('new-expense-created')]
    #[On('new-expense-updated')]
    #[On('expense-deleted')]
    public function render()
    {
        $totalExpensesPerUser = $this->getTotalExpensesPerUser();

        return view('livewire.date.statistik', [
            'date' => $this->date,
            'totalExpensesPerUser' => $totalExpensesPerUser,
        ]);
    }

    public function getTotalExpensesPerUser()
    {
        $totalExpenses = $this->date->expenses->sum('amount');

        $expensesPerUser = $this->date->expenses()
            ->select('paid_by', DB::raw('SUM(amount) as total'))
            ->groupBy('paid_by')
            ->with('payer')
            ->get()
            ->map(function ($expense) use ($totalExpenses) {
                $percentage = ($totalExpenses > 0) ? ($expense->total / $totalExpenses) * 100 : 0;
                return [
                    'name' => $expense->payer->name,
                    'total' => $expense->total,
                    'avatar' => $expense->payer->showAvatar(),
                    'percentage' => $percentage,
                ];
            });

        $maxExpense = $expensesPerUser->max('total');
        $minExpense = $expensesPerUser->min('total');

        return $expensesPerUser->map(function ($expense) use ($maxExpense, $minExpense) {
            if ($maxExpense == $minExpense) {
                $color = 'text-warning';
            } elseif ($expense['total'] == $maxExpense) {
                $color = 'text-success';
            } elseif ($expense['total'] == $minExpense) {
                $color = 'text-danger';
            }
            $expense['color'] = $color;
            return $expense;
        });
    }
}
