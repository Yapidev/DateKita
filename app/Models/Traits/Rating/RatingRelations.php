<?php

namespace App\Models\Traits\Rating;

use App\Models\Date;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait RatingRelations

{
    /**
     * Relasi belongs to ke table users
     *
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi belongs to ke table dates
     *
     * @return BelongsTo
     */
    public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class, 'date_id');
    }
}
