<?php

namespace App\Filament\Admin\Resources\Programs\Pages;

use App\Filament\Admin\Resources\ProgramExercises\ProgramExerciseResource;
use App\Filament\Admin\Resources\Programs\ProgramResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProgram extends CreateRecord
{
    protected static string $resource = ProgramResource::class;
     protected function getRedirectUrl(): string
    {
        // توجيه المستخدم إلى قائمة البرامج بعد الحفظ
        return  ProgramExerciseResource::getUrl('index');
    }
}
