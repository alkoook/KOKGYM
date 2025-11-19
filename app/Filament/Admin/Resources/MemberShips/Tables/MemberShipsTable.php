<?php

namespace App\Filament\Admin\Resources\MemberShips\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;


class MemberShipsTable
{
    public static function configure(Table $table): Table
    {
     return $table
        ->columns([
            // 1. عمود اسم الخطة (name)
            TextColumn::make('name')
                ->label('اسم العضوية')
                ->searchable() // يسمح بالبحث عن الاسم
                ->sortable(), // يسمح بالترتيب

            // 2. عمود المدة بالأيام (duration_days)
            TextColumn::make('duration_days')
                ->label('المدة')
                ->sortable()
                ->suffix(' يوم'), // إضافة لاحقة (مثلاً: 30 يوماً)

            // 3. عمود سعر الخطة (price)
            TextColumn::make('price')
                ->label('السعر')
                ->sortable()
                ->money(currency: 'USD'),
            // 4. عمود حالة التفعيل (is_active)
            IconColumn::make('is_active')
                ->label('الحالة')
                ->boolean(), // عرض كأيقونة صح/خطأ أو تفعيل/إلغاء

            // 5. عمود تاريخ الإنشاء
            TextColumn::make('created_at')
                ->label('تاريخ الإضافة')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true), // يمكن إخفاؤه افتراضياً

        ])
        // يمكنك إضافة الفلاتر والإجراءات هنا
        ->filters([
            //...
        ])
        ->actions([
            //...
        ])
        ->bulkActions([
            //...
        ]);
    }
}
