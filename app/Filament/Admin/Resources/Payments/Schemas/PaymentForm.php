<?php

namespace App\Filament\Admin\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('supplement_id')
                ->label('المكمل .... يمكن تركه فارغاً')
                ->relationship('supplement','name')
                ->nullable(),

                Select::make('machine_id')
                ->label('الآلة .... يمكن تركه فارغاً')
                ->relationship('machine','name')
                ->nullable(),

                TextInput::make('amount')
                ->label("المبلغ")
                ->numeric()->minValue(1)
                ->required(),

                Select::make('payment_method')
                ->label("طريقة الدفع")
                ->options([
                        'cash' => 'نقدي',
                        'card' => 'بطاقة',
                        'transfer' => 'تحويل بنكي',
                ]),
                DatePicker::make('payment_date')
                ->label("تاريخ الدفع")
                ->required(),
                Select::make('type')
                ->label("نوع الدفعة")
                ->options(['income'=>'وارد', 'expense'=>'صادر'])
                ->required(),
                Textarea::make('notes')->label('ملاحظات')

            ]);
    }
}
