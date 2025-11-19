<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\User;
use App\Models\Subscription;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MembersStats extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['admin', 'trainer']);
    }

 protected function getStats(): array
{
    $totalMembers = User::role('member')->count();
    $totalCoaches = User::role('trainer')->count();
    $activeSubscriptions = Subscription::where('is_active', 1)->count();

    $expense = Payment::where('type', 'expense')
        ->where('payment_date', '>=', Carbon::now()->subMonth())
        ->sum('amount');

    $income = Payment::where('type', 'income')
        ->where('payment_date', '>=', Carbon::now()->subMonth())
        ->sum('amount');

    return [
        Stat::make('عدد الأعضاء', $totalMembers)
            ->description('إجمالي عدد الأعضاء المسجلين')
            ->color('success'),

        Stat::make('عدد المدربين', $totalCoaches)
            ->description('عدد المدربين العاملين')
            ->color('primary'),

        Stat::make('الاشتراكات الفعّالة', $activeSubscriptions)
            ->description('اشتراكات فعّالة حالياً')
            ->color('warning'),

        Stat::make('مجموع المصروفات لهذا الشهر', number_format($expense))
            ->description('آخر 30 يوم')
            ->color('danger'),

        Stat::make('مجموع الإيرادات لهذا الشهر', number_format($income))
            ->description('آخر 30 يوم')
            ->color('success'),
    ];
}

}
