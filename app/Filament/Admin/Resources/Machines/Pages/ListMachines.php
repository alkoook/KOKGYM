<?php

namespace App\Filament\Admin\Resources\Machines\Pages;

use App\Filament\Admin\Resources\Machines\MachineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMachines extends ListRecords
{
    protected static string $resource = MachineResource::class;

   public function getTitle(): string
    {
        return 'إدارة الآلات'; 
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة آلة جديدة'),
        ];
    }
}
