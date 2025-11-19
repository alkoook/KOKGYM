<?php

namespace App\Filament\Admin\Resources\Programs\Pages;

use App\Filament\Admin\Resources\Programs\ProgramExerciseResource;
use App\Filament\Admin\Resources\Programs\ProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProgram extends ViewRecord
{
    // ✅ يجب أن تكون داخل الكلاس مباشرة (هذا يحل خطأ initialization)
    protected static string $resource = ProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
    // 🛑 إضافة هذه الدالة لفرض تحميل علاقة exercises 🛑
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // هذه الدالة يتم استدعاؤها أثناء جلب السجل
        // هنا نقوم بتحميل العلاقة 'exercises' مسبقاً
        
        // جلب السجل الحالي
        $record = $this->getRecord();

        // 🛑 فرض تحميل العلاقة 🛑
        $record->load(['exercises']);

        return $data;
    }
}