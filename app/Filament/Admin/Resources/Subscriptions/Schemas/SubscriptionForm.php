<?php

namespace App\Filament\Admin\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                ->label('اللاعب')
                ->required()
                ->relationship(
                    'user',
                    'name',
                    modifyQueryUsing: function (Builder $query) {
                        $query
                            // استبعاد الأدمن والمدربين
                            ->whereDoesntHave('roles', function (Builder $roleQuery) {
                                $roleQuery->whereIn('name', ['admin', 'trainer']);
                            })

                            // استبعاد اللاعبين الذين لديهم اشتراك سابق
                            ->whereDoesntHave('subscriptions');
                    }
                )
                ->searchable()
                ->preload(),
                
                Select::make('membership_id')
                ->label('نوع الاشتراك')
                ->relationship('membership','name')
                ->preload()
                ,
                DatePicker::make('start_date')
                ->label('تاريخ البداية'),
                Toggle::make('is_active')
                    ->label('حالة التفعيل')
                    ->helperText('تفعيل أو إلغاء تفعيل هذا الاشتراك')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')]);
    }
}
