<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    #[On('avatar-updated')]
    #[On('bio-updated')]
    public function render()
    {
        return view('livewire.components.header', [
            'user' => Auth::user()
        ]);
    }
}
