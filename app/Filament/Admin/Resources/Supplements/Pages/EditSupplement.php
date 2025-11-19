<?php

namespace App\Filament\Admin\Resources\Supplements\Pages;

use App\Filament\Admin\Resources\Supplements\SupplementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSupplement extends EditRecord
{
    protected static string $resource = SupplementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
