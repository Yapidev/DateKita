<?php

namespace App\Models;

use App\Models\Traits\Rating\RatingRelation;
use App\Models\Traits\Rating\RatingUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory, RatingRelation, RatingUtilities;

    protected $guarded = ['id'];
}
