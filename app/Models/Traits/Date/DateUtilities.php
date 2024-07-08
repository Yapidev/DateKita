<?php

namespace App\Models\Traits;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

trait DateUtilities

{
    /**
     * Getter untuk mendapatkan rating dari user yang sedang login
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getAuthRating(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Rating::class)->where('user_id', Auth::id());
    }

    /**
     * Mendapatkan status dari entitas, menunjukkan apakah telah di-edit atau belum
     *
     * @return string
     */
    public function getStatus(): string
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
