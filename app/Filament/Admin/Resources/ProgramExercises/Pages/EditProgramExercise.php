<?php

namespace App\Filament\Admin\Resources\ProgramExercises\Pages;

use App\Filament\Admin\Resources\ProgramExercises\ProgramExerciseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramExercise extends EditRecord
{
    protected static string $resource = ProgramExerciseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
