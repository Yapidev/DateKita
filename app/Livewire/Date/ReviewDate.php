<?php

namespace App\Livewire\Date;

use App\Models\Date;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReviewDate extends Component
{
    public Date $date;
    public $ratings;
    public $rating, $comment;

    public function mount($date_id)
    {
        $this->date = Date::find($date_id);
        $authRating = $this->date->getAuthRating();

        if ($authRating) {
            $this->rating = $authRating->rating;
            $this->comment = $authRating->comment;
        }
    }

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:255',
    ];

    protected $messages = [
        'rating.required' => 'Rating harus diisi.',
        'rating.integer' => 'Rating harus berupa angka.',
        'rating.min' => 'Rating minimal adalah 1.',
        'rating.max' => 'Rating maksimal adalah 5.',
        'comment.required' => 'Komentar harus diisi.',
        'comment.string' => 'Komentar harus berupa teks.',
        'comment.max' => 'Komentar maksimal 255 karakter.',
    ];

    public function render()
    {
        $this->ratings = $this->date->ratings()->with('users')->get();
        $ratings = $this->ratings;

        return view('livewire.date.review-date', [
            'ratings' => $ratings
        ]);
    }

    public function submitRating()
    {
        $this->validate();

        Rating::updateOrCreate([
            'user_id' => Auth::id(),
            'date_id' => $this->date->id,
        ], [
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->notify('Berhasil', 'Berhasil memberi rating!', 'success');
    }

    public function notify(string $title, string $message, string $icon)
    {
        return $this->dispatch('notify', title: $title, message: $message, icon: $icon)->self();
    }
}
