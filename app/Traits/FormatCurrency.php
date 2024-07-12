<?php

namespace App\Traits;

trait FormatCurrency
{
    /**
     * Format a given amount into Rupiah currency.
     *
     * @param float|int $amount
     * @return string
     */
    public function formatCurrency($amount)
    {
        return 'Rp. ' . number_format($amount, 0, ',', '.');
    }
}
