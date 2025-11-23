<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form; // ✅ الكلاس الصحيح لاستخدامه في دالة configure

use Filament\Schemas\Schema;

class UserForm
{
    // 💡 يجب أن تستقبل الدالة كائن Filament\Forms\Form وتعيده
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')->label('الاسم')->required(),
                TextInput::make('email')->label('البريد الإلكتروني')->email()->required(),

                // حقل كلمة المرور (إلزامي في الإنشاء، مخفي في التعديل)
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create') // إلزامي فقط في الإنشاء
                    ->hiddenOn('edit'),

                DatePicker::make('birth_date')->label('تاريخ الميلاد')->required(),
                TextInput::make('phone')->label('رقم الجوال')->tel()->required(),

              FileUpload::make('photo')
                ->label('الصورة')
                ->disk('members')
                ->directory('')
                ->visibility('public')
                ->image(),


                TextInput::make('uid')
                    ->label('UID'),

                TextInput::make('height')
                    ->label('الطول (سم)')
                    ->numeric()
                    ->minValue(50)
                    ->maxValue(300)
                    ->nullable(),

                TextInput::make('weight')
                    ->label('الوزن (كغ)')
                    ->numeric()
                    ->minValue(20)
                    ->maxValue(400)
                    ->step('0.1')
                    ->nullable(),
                // حقل اختيار الدور (باستخدام Spatie)
                Select::make('role')
                    ->label('الدور')
                    ->options([
                    'admin'   => 'آدمن',
                    'trainer' => 'مدرب',
                    'member'  => 'متدرب',
                ])
                    ->required()
            ])
            ->columns(2);
    }
}
