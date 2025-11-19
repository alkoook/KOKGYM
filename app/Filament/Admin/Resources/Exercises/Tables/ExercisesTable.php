<?php

namespace App\Filament\Admin\Resources\Exercises\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ExercisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('اسم التمرين')->searchable()->sortable(),
                TextColumn::make('description')->label('وصف التمرين'),
                TextColumn::make('category')->label('العضلة المستهدفة')->sortable()->searchable(),
                TextColumn::make('level')->label('مستوى التمرين')
                ->formatStateUsing(function($state){
                    return $state ==='beginner' ? "مبتدئ" :($state === 'intermediate' ? 'متوسط' : ($state === 'advanced' ? 'متقدم' : ''))
                ;})
                ->sortable(),
                TextColumn::make('machine.name')->label('الآلة')->sortable()->searchable(),
                TextColumn::make('video')
                            ->label('الفيديو التوضيحي')
                            ->html()
                            ->getStateUsing(function ($record) {
                                if (!$record->video) {
                                    return '<span style="color: gray;">لا يوجد فيديو</span>';
                                }
                                $url = Storage::disk('exercise')->url($record->video);

                                return <<<HTML
                                    <video width="200" height="120" controls muted style="border-radius: 20px;">
                                        <source src="{$url}">
                                        متصفحك لا يدعم تشغيل الفيديو.
                                    </video>
                                HTML;
                            }),
                
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
