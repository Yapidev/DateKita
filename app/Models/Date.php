<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Date extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
     * @return hasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Getter untuk mendapatkan semua data date dan diurutkan dari yang terbaru berdasarkan kolom date_time
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllDatesOrderedByDateTime()
    {
        return self::orderBy('date_time', 'desc')->get();
    }

    /**
     * Getter untuk mendapatkan rating dari user yang sedang login
     *
     * @return void
     */
    public function getAuthRating()
    {
        return $this->ratings()->where('user_id', Auth::id());
    }

    /**
     * Accessor untuk mendapatkan atribut average_rating
     *
     * @return void
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    /**
     * Accessor untuk kolom description
     *
     * @param  string|null  $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return $value ?? 'Tidak ada deskripsi';
    }

    /**
     * Accessor untuk atribut total_expenses
     *
     * @return string
     */
    public function getTotalExpensesAttribute()
    {
        $totalExpenses = $this->expenses->sum('amount');

        if ($totalExpenses == null) {
            return 'Tidak ada pengeluaran';
        } else {
            return 'Rp. ' . number_format($totalExpenses, 0, ',', '.');
        }
    }
}
