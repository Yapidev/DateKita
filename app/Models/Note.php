<?php

namespace App\Models;

use App\Models\Traits\Note\NoteRelations;
use App\Models\Traits\Note\NoteUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, NoteRelations, NoteUtilities;

    protected $guarded = ['id'];
}
