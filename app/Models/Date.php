<?php

namespace App\Models;

use App\Models\Traits\Date\DateAccessors;
use App\Models\Traits\Date\DateRelation;
use App\Models\Traits\DateUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory, DateRelation, DateAccessors, DateUtilities;

    protected $guarded = ['id'];
}
