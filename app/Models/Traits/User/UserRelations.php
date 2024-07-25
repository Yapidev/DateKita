<?php

namespace App\Models\Traits\User;

use App\Models\Date;
use App\Models\Expense;
use App\Models\Favorite;
use App\Models\Note;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * Relasi has many ke table notes
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    /**
     * favorites
     *
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * favoriteNotes
     *
     * @return void
     */
    public function favoriteNotes()
    {
        return $this->morphedByMany(Note::class, 'favoritable', 'favorites');
    }
}
