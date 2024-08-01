<?php

namespace App\Models\Traits\Expense;

use App\Models\Date;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ExpenseRelations

{
    /**
     * Relasi belongs to ke table date
     *
     * @return BelongsTo
     */
    public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class, 'date_id');
    }

    /**
     * Relasi belongs to ke table user untuk mendapatkan pembayar
     *
     * @return BelongsTo
     */
    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
}
