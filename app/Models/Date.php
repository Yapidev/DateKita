<?php

namespace App\Models;

use App\Models\Traits\Date\DateAccessors;
use App\Models\Traits\Date\DateRelations;
use App\Models\Traits\Date\DateUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory, DateRelations, DateAccessors, DateUtilities;

    protected $guarded = ['id'];
}
