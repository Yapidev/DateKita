<?php

namespace App\Models;

use App\Models\Traits\Expenses\ExpensesAccessors;
use App\Models\Traits\Expenses\ExpensesRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, ExpensesRelations, ExpensesAccessors;

    protected $guarded = ['id'];
}
