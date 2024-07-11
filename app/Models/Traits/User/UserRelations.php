<?php

namespace App\Models\Traits\User;

use App\Models\Date;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelations

{
    /**
     * Relasi untuk mendapatkan date user terkait
     *
     * @return BelongsToMany
     */
    public function dates(): BelongsToMany
    {
        return $this->belongsToMany(Date::class, 'user_dates')->withTimestamps();
    }

    /**
     * Relasi has many ke table expenses
     *
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'paid_by');
    }
}
