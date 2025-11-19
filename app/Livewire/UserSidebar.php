<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Subscription;
use App\Models\Payment;
use Carbon\Carbon;

class UserSidebar extends Component
{
    public $todayAttendance = 0;
    public $activeSubscriptions = 0;
    public $monthlyIncome = 0;
    public $monthlyExpense = 0;

    public function mount()
    {
        // مؤقت - للتجربة عيّن أرقام ثابتة أولاً
        // $this->todayAttendance = 5;
        // $this->activeSubscriptions = 10;
        // $this->monthlyIncome = 100000;
        // $this->monthlyExpense = 40000;

        // أو فعلياً:
        $this->todayAttendance = Attendance::whereDate('created_at', Carbon::today())->count();
        $this->activeSubscriptions = Subscription::where('is_active', 1)->count();
        $this->monthlyIncome = Payment::where('type', 'income')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->sum('amount');
        $this->monthlyExpense = Payment::where('type', 'expense')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->sum('amount');
    }

    public function render()
    {
        // مهم: **لا تمرّر المتغيرات هنا**، Livewire يمرّرها تلقائياً
        return view('livewire.user-sidebar');
    }
}
