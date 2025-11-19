<?php

namespace App\Filament\Admin\Resources\Machines\Pages;

use App\Filament\Admin\Resources\Machines\MachineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;


class EditMachine extends EditRecord
{
    protected static string $resource = MachineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
  public function handleRecordUpdate(Model $record, array $data): Model{
     if (!empty($data['image']) && $data['image'] !== $record->image) {
            if ($record->image && Storage::disk('machines')->exists($record->image)) {
                Storage::disk('machines')->delete($record->image);
            }}
        $record->update($data);
        return $record;
  }

}
