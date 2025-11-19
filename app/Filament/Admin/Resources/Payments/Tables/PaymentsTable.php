<?php

namespace App\Filament\Admin\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')
                ->label('المبلغ')
                ->money('USD')
                ->sortable(),
                TextColumn::make('payment_method')
                ->label('طريقة الدفع')
                ->sortable(),
                TextColumn::make('payment_date')
                ->label('وقت الدفع')->sortable(),
                TextColumn::make('type')
                ->label('نوع الدفعة')
                ->sortable('desc')
                ->formatStateUsing(function ($state) {
                    return $state === 'expense' ? 'صادر' : ($state === 'income' ? 'وارد' : $state);
                }),
                TextColumn::make('notes')
                ->label('ملاحظات')
                ->searchable()

            ])
            ->filters([
                //
            ])
            ->recordActions([
            DeleteAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
