<?php

namespace App\Filament\Admin\Resources\ProgramResource\Pages;

use App\Filament\Admin\Resources\ProgramResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ViewProgram extends ViewRecord
{
    protected static string $resource = ProgramResource::class;

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getViewData(): array
    {
        $program = $this->record->load(['exercises' => function ($query) {
            $query->orderBy('program_exercise.day');
        }]);

        $grouped = $program->exercises->groupBy('pivot.day');

        return [
            'program' => $program,
            'groupedExercises' => $grouped,
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $data = $this->getViewData();
        return view('filament.admin.resources.programs.view', $data);
    }
}
