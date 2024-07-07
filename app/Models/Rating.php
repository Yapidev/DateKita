<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public function getStatus()
    {
        $created = $this->created_at;
        $updated = $this->updated_at;

        if ($updated != $created) {
            return '(Di edit) ' . $updated->diffForHumans();
        } else {
            return $created->diffForHumans();
        }
    }
}
