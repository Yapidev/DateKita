<?php

namespace App\Models\Traits\Comment;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CommentRelations
{
    /**
     * Relasi belongsTo ke model note
     *
     * @return BelongsTo
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    /**
     * Relasi belongsTo ke model user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
