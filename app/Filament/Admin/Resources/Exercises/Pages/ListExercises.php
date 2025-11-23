<?php

namespace App\Filament\Admin\Resources\Exercises\Pages;

use App\Filament\Admin\Resources\Exercises\ExerciseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListExercises extends ListRecords
{
    protected static string $resource = ExerciseResource::class;

    public function getTitle(): string
    {
        return 'إدارة التمارين';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة تمرين جديد'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->with('machine'); // Eager load machine to prevent N+1 queries
    }
}
