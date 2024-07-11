<?php

namespace App\Models\Traits\User;

trait UserUtilities

{
    /**
     * Fungsi untuk menampilkan avatar user
     *
     * @return string
     */
    public function showAvatar(): string
    {
        if (!$this->avatar) {
            return $this->gender == 'male'
                ? 'assets/images/profile/user-1.jpg'
                : 'assets/images/profile/user-2.jpg';
        }

        return 'storage/users-avatar/' . $this->avatar;
    }
}
