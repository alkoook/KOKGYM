<?php

namespace App\Filament\Admin\Resources\MemberShips\Schemas;

// تم إزالة use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MemberShipForm
{
    // تم تصحيح توقيع الدالة لاستقبال وإرجاع كائن من نوع Form (كما طلبنا في المرة السابقة)
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
            
                        // 1. حقل اسم الخطة (name)
                        TextInput::make('name')
                            ->label('اسم خطة العضوية')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true) // فريد باستثناء السجل الحالي عند التعديل
                            ->columnSpan(1),

                        // 2. حقل المدة بالأيام (duration_days)
                        TextInput::make('duration_days')
                            ->label('المدة بالأيام')
                            ->helperText('أدخل مدة الاشتراك باليوم (مثلاً: 30 يوماً)')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->integer() // التأكد من أنها رقم صحيح
                            ->columnSpan(1),

                // 3. حقل سعر الخطة (price)
                TextInput::make('price')
                    ->label('سعر الخطة')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal') // لتسهيل إدخال الفواصل العشرية
                    ->prefix('USD') // مثلاً: إضافة رمز العملة
                    ->columnSpan(2), // عرض كامل

                // 4. حقل التفعيل (is_active)
                Toggle::make('is_active')
                    ->label('حالة التفعيل')
                    ->helperText('تفعيل أو إلغاء تفعيل هذه الخطة للاشتراك بها')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')]);
    }
}