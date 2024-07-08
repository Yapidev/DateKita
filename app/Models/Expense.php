<?php

namespace App\Models;

use App\Models\Traits\Expenses\ExpensesAccessor;
use App\Models\Traits\Expenses\ExpensesRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, ExpensesRelation, ExpensesAccessor;

    protected $guarded = ['id'];
}
