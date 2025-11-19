<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Attendance;
use App\Models\Machine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 💰 تقارير مالية
        $income  = Payment::where('type', 'income')->sum('amount');
        $expense = Payment::where('type', 'expenseve')->sum('amount');
        $totalPayments = $income ;
        $activeSubscriptions = Subscription::where('end_date', '>=', Carbon::today())->count();
        $expiredSubscriptions = Subscription::where('end_date', '<', Carbon::today())->count();

        // 📅 تقارير الحضور
        $todayAttendance = Attendance::whereDate('check_in_time', Carbon::today())->count();
        $monthAttendance = Attendance::whereMonth('check_in_time', Carbon::now()->month)->count();

        // 🏋️‍♂️ أكثر الأعضاء حضوراً
        $topMembers = Attendance::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderBy('total', 'DESC')
            ->take(5)
            ->get();

        // 🛠️ أكثر الماكينات استخداماً
        // $mostUsedMachines = Attendance::select('machine_id', DB::raw('COUNT(*) as total'))
        //     ->groupBy('machine_id')
        //     ->orderBy('total', 'DESC')
        //     ->take(5)
        //     ->get();

        // 👨‍🏫 أكثر المدربين نشاطاً
        $topTrainers = Machine::select('trainer_id', DB::raw('COUNT(*) as machines_count'))
            ->groupBy('trainer_id')
            ->orderBy('machines_count', 'DESC')
            ->take(5)
            ->get();

        // رجع البيانات كلها كـ JSON (API) أو تمررها للـ View
        return response()->json([
            'totalPayments' => $totalPayments,
            'activeSubscriptions' => $activeSubscriptions,
            'expiredSubscriptions' => $expiredSubscriptions,
            'todayAttendance' => $todayAttendance,
            'monthAttendance' => $monthAttendance,
            'topMembers' => $topMembers,
            // 'mostUsedMachines' => $mostUsedMachines,
            'topTrainers' => $topTrainers,
        ]);
    }
}

