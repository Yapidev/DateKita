<?php

namespace App\Models;

use App\Models\Traits\Comment\CommentRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, CommentRelations;

    protected $guarded = ['id'];
}
