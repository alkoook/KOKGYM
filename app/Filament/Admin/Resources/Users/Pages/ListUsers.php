<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'إدارة المستخدمين'; 
    }
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة مستخدم جديد'),
        ];
    }
    
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->with('roles'); // Eager load roles to prevent N+1 queries
    }
}
