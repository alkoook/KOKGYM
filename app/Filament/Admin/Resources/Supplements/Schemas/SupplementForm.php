<?php

namespace App\Filament\Admin\Resources\Supplements\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class SupplementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
          TextInput::make('name')
                    ->label('اسم المكمل')
                    ->required(),

                Textarea::make('description')
                    ->label('وصف المكمل'),

                Select::make('type')
                    ->label('نوع المكمل')
                    ->options([
                        'vitamin' => 'فيتامين',
                        'protein' => 'بروتين',
                        'mineral' => 'معدن',
                        'herbal' => 'أعشاب',
                        'supplement' => 'مكمل غذائي',
                        'creatine' => ' كرياتين',
                        'snack' => ' سناكات صحية',
                    ])
                    ->required(),

                TextInput::make('quantity')
                    ->label('الكمية')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                     TextInput::make('purpose')
                    ->label('لمحة عن المكمل'),
                    TextInput::make('origin_country')
                    ->label('بلد المنشأ')
                    ->required(),

                TextInput::make('purchase_price')
                    ->label('سعر الشراء')
                    ->numeric()
                    ->step(0.01)
                    ->required(),

                TextInput::make('sale_price')
                    ->label('سعر البيع')
                    ->numeric()
                    ->step(0.01)
                    ->required(),


                Textarea::make('usage')
                    ->label('طريقة الاستخدام')
                    ->required(),
                FileUpload::make('image')->label('صورة المكمل')
                ->disk('supplements')->visibility('public')
                ->getUploadedFileNameForStorageUsing(function($file){
                    return 'SUPPLEMEMNT_'. now()->format('Ymd_His'). '.'.$file->getClientOriginalExtension();
                })
            ]);
    }
}
