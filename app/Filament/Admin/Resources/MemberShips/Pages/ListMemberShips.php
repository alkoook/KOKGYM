<?php

namespace App\Filament\Admin\Resources\MemberShips\Pages;

use App\Filament\Admin\Resources\MemberShips\MemberShipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberShips extends ListRecords
{
    protected static string $resource = MemberShipResource::class;

  public function getTitle(): string
    {
        return 'إدارة العضويات'; 
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('إضافة اشتراكات جديدة'),
        ];
    }
}
