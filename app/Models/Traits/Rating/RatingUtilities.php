<?php

namespace App\Models\Traits\Rating;

trait RatingUtilities

{
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
