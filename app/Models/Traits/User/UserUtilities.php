<?php

namespace App\Models\Traits\User;

use Carbon\Carbon;

trait UserUtilities

{
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
     * @return string
     */
    public function getCurrentMonthExpense(): string
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $expense = $this->expenses()->whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('amount');

        return 'Rp. ' . number_format($expense, 0, ',', '.');
    }

    /**
     * Fungsi untuk format atribut target expense
     *
     * @return string
     */
    public function getFormattedTargetExpenses(): string
    {
        return 'Rp. ' . number_format($this->target_expenses, 0, ',', '.');
    }
}
