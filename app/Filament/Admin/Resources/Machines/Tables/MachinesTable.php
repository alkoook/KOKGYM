<?php

namespace App\Filament\Admin\Resources\Machines\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MachinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('اسم الآلة')->searchable()->sortable(),
                TextColumn::make('origin_country')->label('بلد المنشأ')->sortable()->searchable(),
                TextColumn::make('price')->label('سعر الآلة')->money()->color('primary')->sortable(),
                ImageColumn::make(name: 'image')->label('الصورة')->disk('machines')->rounded()->size(100)

                ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
