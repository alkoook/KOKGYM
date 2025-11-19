<?php

namespace App\Filament\Admin\Resources\Attendances\Pages;

use App\Filament\Admin\Resources\Attendances\AttendanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;
    public function getTitle():string{
        return 'الحضور';
    }
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make()->label('إضافة حضور جديد'),
    //     ];
    // }
}
