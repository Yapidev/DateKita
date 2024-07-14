<?php

namespace App\Models;

use App\Models\Traits\Expenses\ExpensesAccessors;
use App\Models\Traits\Expenses\ExpensesRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory, ExpensesRelations, ExpensesAccessors;

    protected $guarded = ['id'];

    /**
     * Relasi ke model date
     *
     * @return BelongsTo
     */
    public function date(): BelongsTo
    {
        return $this->belongsTo(Date::class);
    }
}
