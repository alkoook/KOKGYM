<?php

namespace App\Filament\Admin\Resources\Programs\Pages;

use App\Filament\Admin\Resources\Programs\ProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPrograms extends ListRecords
{
    protected static string $resource = ProgramResource::class;

    public function getTitle(): string
    {
        return 'إدارة البرامج'; 
    }
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة برنامج جديد'),
        ];
    }
    
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->with('creator'); // Eager load creator to prevent N+1 queries
    }
}
