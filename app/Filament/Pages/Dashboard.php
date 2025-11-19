<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MembersChart;
use App\Filament\Widgets\MembersStats;
use Filament\Facades\Filament;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.Dashboard';
    public static function canView(): bool
{
    $user = auth()->user();
    return $user && $user->hasRole(['admin', 'trainer']);
}
    protected static bool $shouldRegisterNavigation = false;


    public function getWidgetData(): array{
        return [
                     MembersStats::class,
                    //  MembersChart::class
        ];
    }
}
