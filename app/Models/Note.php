<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi untuk mendapatkan author
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * favorites
     *
     * @return MorphMany
     */
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    /**
     * scopeWithFavoritesFirst
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeWithFavoritesFirst($query)
    {
        $userId = auth()->id();

        return $query->leftJoin('favorites', function ($join) use ($userId) {
            $join->on('favorites.favoritable_id', '=', 'notes.id')
                ->where('favorites.favoritable_type', '=', Note::class)
                ->where('favorites.user_id', '=', $userId);
        })
            ->select('notes.*')
            ->orderByRaw('CASE WHEN favorites.user_id IS NOT NULL THEN 0 ELSE 1 END')
            ->orderBy('notes.created_at', 'desc');
    }
}
