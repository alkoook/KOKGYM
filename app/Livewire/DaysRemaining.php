<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Subscription;

class DaysRemaining extends Component
{
    public $daysLeft;

    public function mount()
    {
        $sub = Subscription::where('user_id', auth()->id())->first();

        $this->daysLeft = $sub && $sub->end_date
            ? intval(Carbon::now()->diffInDays(Carbon::parse($sub->end_date), false))
            : 0;
    }

    public function render()
    {
        return view('livewire.days-remaining');
    }
}
