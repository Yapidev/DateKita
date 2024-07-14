<?php

namespace App\Models\Traits\User;

use App\Traits\FormatCurrency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait UserUtilities

{
    use FormatCurrency;

    /**
     * Fungsi untuk menampilkan avatar user
     *
     * @return string
     */
    public function showAvatar(): string
    {
        if (!$this->avatar) {
            return $this->gender == 'male'
                ? 'assets/images/profile/user-1.jpg'
                : 'assets/images/profile/user-2.jpg';
        }

        return 'storage/users-avatar/' . $this->avatar;
    }

    /**
     * Fungsi untuk mendapatkan total pengeluaran user di bulan ini
     *
     * @return int
     */
    public function getCurrentMonthExpense(): int
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $expense = $this->expenses()
            ->whereHas('date', function (Builder $query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('date_time', [$startOfMonth, $endOfMonth]);
            })
            ->sum('amount');

        return $expense;
    }

    public function getFormattedCurrentMonthExpense(): string
    {
        $expense =  $this->getCurrentMonthExpense();
        return $this->formatCurrency($expense);
    }

    /**
     * Fungsi untuk format atribut target expense
     *
     * @return string
     */
    public function getFormattedTargetExpenses(): string
    {
        return $this->formatCurrency($this->target_expenses);
    }
}
