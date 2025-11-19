<?php

namespace App\Filament\Admin\Resources\MemberShips\Pages;

use App\Filament\Admin\Resources\MemberShips\MemberShipResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberShip extends EditRecord
{
    protected static string $resource = MemberShipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
