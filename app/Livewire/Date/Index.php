<?php

namespace App\Livewire\Date;

use App\Models\Date;
use Livewire\Component;

class Index extends Component
{
    public int $dateId;

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
