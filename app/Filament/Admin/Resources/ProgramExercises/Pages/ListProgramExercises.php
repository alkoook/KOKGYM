<?php

namespace App\Filament\Admin\Resources\ProgramExercises\Pages;

use App\Filament\Admin\Resources\ProgramExercises\ProgramExerciseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramExercises extends ListRecords
{
    protected static string $resource = ProgramExerciseResource::class;

  protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة برنامج جديد'),
            
        ];
    }
}
