<?php

namespace App\Filament\Admin\Resources\Machines\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Schemas\Schema;

class MachineForm
{
    
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('اسم الآلة')
                    ->required(),

                TextInput::make('origin_country')
                    ->label('بلد المنشأ')
                    ->nullable(),

                TextInput::make('price')
                    ->label('السعر')
                    ->numeric(2)
                    ->required(),

               FileUpload::make('image')
                    ->label('صورة الآلة')
                    ->image()
                    ->disk('machines')
                    ->directory('images')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(function ($file) {
                    return 'MACHINE_'.now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                })
                    ->nullable()
            ])
            ->columns(2); // تنسيق الحقول على عمودين
    }
}
