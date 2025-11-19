<?php

namespace App\Filament\Admin\Resources\Exercises\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use App\Models\Exercise;

class ExerciseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('اسم التمرين')
                    ->required(),

                Textarea::make('description')
                    ->label('الوصف')
                    ->required(),

                FileUpload::make('video')
                    ->label('فيديو التمرين')
                    ->acceptedFileTypes(['video/mp4', 'video/mpeg', 'video/avi'])
                    ->disk('exercise')->directory('videos') 
                      ->getUploadedFileNameForStorageUsing(function ($file) {
                    return 'EXERCISE_'.now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                })
                    ->visibility('public')
                    ->required(),

                TextInput::make('category')
                    ->label('الفئة')
                    ->nullable(),

                Select::make('level')
                    ->label('المستوى')
                    ->options([
                        'beginner' => 'مبتدئ',
                        'intermediate' => 'متوسط',
                        'advanced' => 'متقدم',
                    ])
                    ->default('beginner')
                    ->required(),

                Select::make('machine_id')
                    ->label('الآلة')
                    ->relationship('machine', 'name')
                    ->nullable(),
            ])
            ->columns(2); // توزيع الحقول على عمودين
    }
}
