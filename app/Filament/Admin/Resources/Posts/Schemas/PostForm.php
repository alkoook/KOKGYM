<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
           TextInput::make('title')
            ->label('عنوان البوست')
            ->required()
            ->maxLength(255),

        Textarea::make('body')
            ->label('محتوى البوست')
            ->required()
            ->columnSpanFull(),


        FileUpload::make('image')
                    ->label('صورة عن البوست')
                    ->disk('posts')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(function ($file) {
                    return 'POST_'.now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                })
                ->nullable(),

        DatePicker::make('published_at')
            ->label('تاريخ النشر')
            ->nullable(),

        Toggle::make('is_active')
            ->label('فعال')
            ->default(true),
        Hidden::make('user_id')
    ->default(fn () => auth()->id())
    ]);
    }
}
