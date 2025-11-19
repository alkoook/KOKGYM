<?php

namespace App\Filament\Admin\Resources\Subscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('اللاعب')
                ->searchable()
                ->sortable(),
                TextColumn::make('membership.name')
                ->label('الاشتراك')
                ->sortable(),
                TextColumn::make('start_date')
                ->label('تاريخ بدء الاشتراك'),
                TextColumn::make('end_date')
                ->label('تاريخ انتهاء الاشتراك'),
            TextColumn::make('is_active')
            ->label('حالة الاشتراك')
            ->badge() // 💡 الأفضل: عرض الحالة كشارة (Badge)
            ->formatStateUsing(fn (bool $state): string => $state ? 'مُفعَّل' : 'غير مُفعَّل')
            ->color(fn (bool $state): string => match ($state) {
                true => 'success', // أخضر للحالة المُفعَّلة
                false => 'danger', // أحمر للحالة غير المُفعَّلة
            })
            ->sortable(),
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
