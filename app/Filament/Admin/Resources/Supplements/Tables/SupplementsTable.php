<?php

namespace App\Filament\Admin\Resources\Supplements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SupplementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('اسم المكمل')
                ->sortable()->searchable(),
                TextColumn::make('description')
                ->label('وصف المكمل'),
                  TextColumn::make('type')
                ->label('نوع المكمل')
                ->sortable()->searchable(),
                  TextColumn::make('quantity')
                ->label(' العدد المتبقي'),
                  TextColumn::make('purchase_price')
                ->label(' سعر الشراء'),
                 TextColumn::make('sale_price')
                ->label(' سعر المبيع'),
                 TextColumn::make('usage')
                ->label('طريقة الاستخدام'),
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
