<?php

namespace App\Models\Traits\Date;

use App\Models\Expense;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait DateRelations

{
    /**
     * Relasi untuk mendapatkan user di date terkait
     *
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_dates')->withTimestamps();
    }

    /**
     * Relasi has many ke table expense
     *
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Relasi belongs to ke table ratings
     *
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
