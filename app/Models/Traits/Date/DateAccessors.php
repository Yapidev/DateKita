<?php

namespace App\Models\Traits\Date;

trait DateAccessors

{
    /**
     * Accessor untuk mendapatkan atribut average_rating
     *
     * @return float
     */
    public function getAverageRatingAttribute(): float
    {
        return (float) $this->ratings()->avg('rating');
    }

    /**
     * Accessor untuk kolom description
     *
     * @param  string|null  $value
     * @return string
     */
    public function getDescriptionAttribute(?string $value): string
    {
        return $value ?? 'Tidak ada deskripsi';
    }

    /**
     * Accessor untuk atribut total_expenses
     *
     * @return string
     */
    public function getTotalExpensesAttribute(): string
    {
        $totalExpenses = $this->expenses->sum('amount');

        if ($totalExpenses === null) {
            return 'Tidak ada pengeluaran';
        } else {
            return 'Rp. ' . number_format($totalExpenses, 0, ',', '.');
        }
    }
}
