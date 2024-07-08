<?php

namespace App\Models\Traits\Expenses;

trait ExpensesAccessors

{
    /**
     * Accessor untuk kolom amount yang diformat
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return 'Rp. ' . number_format($this->amount, 0, ',', '.');
    }
}
