<?php

namespace App\Models;

use App\Models\Traits\Expense\ExpenseAccessors;
use App\Models\Traits\Expense\ExpenseRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, ExpenseRelations, ExpenseAccessors;

    protected $guarded = ['id'];
}
