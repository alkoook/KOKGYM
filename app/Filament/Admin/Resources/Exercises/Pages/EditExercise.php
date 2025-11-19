<?php

namespace App\Filament\Admin\Resources\Exercises\Pages;

use App\Filament\Admin\Resources\Exercises\ExerciseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class EditExercise extends EditRecord
{
    protected static string $resource = ExerciseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
      public function handleRecordUpdate(Model $record, array $data): Model{
     if (!empty($data['video']) && $data['video'] !== $record->video) {
            if ($record->video && Storage::disk('exercise')->exists($record->video)) {
                Storage::disk('exercise')->delete($record->video);
            }}
        $record->update($data);
        return $record;
  }
}
