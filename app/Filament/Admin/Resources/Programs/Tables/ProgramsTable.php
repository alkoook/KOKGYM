<?php

namespace App\Filament\Admin\Resources\Programs\Schemas;

use App\Models\Program;
use App\Services\ProgramExporter;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Icons\Heroicon;

class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('اسم البرنامج')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('الوصف')
                    ->limit(50),

                TextColumn::make('creator.name')
                    ->label('المدرب'),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
       Action::make('download_word')
    ->label('تحميل Word')
    ->icon(Heroicon::DocumentArrowDown)
    ->action(function (Program $record, ProgramExporter $exporter) {
        $filePath = $exporter->exportProgram($record);
        return response()->download($filePath);
    })
    ->color('info')
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
