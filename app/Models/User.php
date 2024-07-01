<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = ['id'];

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
        return $this->hasMany(Expense::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Fungsi untuk menampilkan avatar user
     *
     * @return void
     */
    public function showAvatar()
    {
        if (!$this->avatar) {
            return $this->gender == 'male'
                ? 'assets/images/profile/user-1.jpg'
                : 'assets/images/profile/user-2.jpg';
        }

        return 'storage/' . $this->avatar;
    }

    /**
     * Accessor untuk mendapatkan atribut name
     *
     * @param  mixed $value
     * @return void
     */
    // public function getNameAttribute($value)
    // {
    //     return $this->id == Auth::id()
    //         ? 'Kamu'
    //         : $value;
    // }
}
