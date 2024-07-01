<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    /**
     * Accessor untuk kolom amount
     *
     * @param  float  $value
     * @return string
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp. ' . number_format($this->amount, 0, ',', '.');
    }
}
