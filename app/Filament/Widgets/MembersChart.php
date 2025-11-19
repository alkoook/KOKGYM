<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class MembersChart extends ChartWidget
{
    public ?string $heading = 'إحصائيات الدخل والمصروفات';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['admin', 'trainer']);
    }

    public array|string|int $columnSpan = 'full';

    protected function getData(): array
    {
        // Query واحدة تجمع كل شيء
        $stats = Payment::selectRaw("
                MONTH(payment_date) as month,
                SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income,
                SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense
            ")
            ->whereYear('payment_date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // تجهيز الـ Labels
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(null, $month)->format('M');
        });

        // تجهيز الـ Data بدون Query إضافية
        $income = collect(range(1, 12))->map(fn ($m) => $stats[$m]->income ?? 0);
        $expense = collect(range(1, 12))->map(fn ($m) => $stats[$m]->expense ?? 0);

        return [
            'datasets' => [
                [
                    'label' => 'الإيرادات',
                    'data' => $income,
                    'borderColor' => '#22c55e',
                    'backgroundColor' => '#22c55e55',
                ],
                [
                    'label' => 'المصروفات',
                    'data' => $expense,
                    'borderColor' => '#ef4444',
                    'backgroundColor' => '#ff000055',
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
