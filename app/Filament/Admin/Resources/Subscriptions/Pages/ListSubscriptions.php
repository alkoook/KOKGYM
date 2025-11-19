<?php

namespace App\Filament\Admin\Resources\Subscriptions\Pages;

use App\Filament\Admin\Resources\Subscriptions\SubscriptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    public function getTitle(): string
    {
        return 'إدارة الاشتراكات'; 
    }
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة اشتراك جديد'),
        ];
    }
    
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->with(['user', 'membership']); // Eager load relationships to prevent N+1 queries
    }
}
