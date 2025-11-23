<?php

namespace App\Filament\Admin\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('title')
                ->label('عنوان البوست')
                ->sortable()
                ->searchable(),

            TextColumn::make('body')
                ->label('المحتوى'),

            ImageColumn::make('image')
                ->label('صورة البوست')
                ->disk('posts')
                ->rounded()             // يجعلها مدوّرة
                ->height(100)            // ارتفاع الصورة
                ->width(100)             // عرض الصورة
                // ->extraImgAttributes(['style' => 'object-fit: cover;']),
     ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
