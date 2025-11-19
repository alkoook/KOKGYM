<?php

namespace App\Filament\Admin\Resources\Supplements\Pages;

use App\Filament\Admin\Resources\Supplements\SupplementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSupplements extends ListRecords
{
    protected static string $resource = SupplementResource::class;

    public function getTitle(): string
    {
        return 'إدارة المكملات'; 
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة مكمل جديد'),
        ];
    }
}
