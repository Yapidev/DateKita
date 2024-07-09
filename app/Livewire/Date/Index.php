<?php

namespace App\Livewire\Date;

use App\Models\Date;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public int $dateId;

    #[On('new-expense-created')]
    #[On('new-expense-updated')]
    #[On('expense-deleted')]
    public function render()
    {
        $date = Date::query()
            ->with(['expenses.payer', 'ratings'])
            ->findOrFail($this->dateId);

        return view('livewire.date.index', [
            'date' => $date
        ]);
    }
}
