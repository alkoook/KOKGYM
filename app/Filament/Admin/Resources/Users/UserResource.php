<?php

namespace App\Filament\Admin\Resources\Users;

use App\Filament\Admin\Resources\Users\Pages\CreateUser;
use App\Filament\Admin\Resources\Users\Pages\EditUser;
use App\Filament\Admin\Resources\Users\Pages\ListUsers;
use App\Filament\Admin\Resources\Users\Schemas\UserForm;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;


class UserResource extends Resource
{
      public static function canAccess(): bool
{
    $user = auth()->user();
    return $user && (
        $user->hasRole('admin')
    );
}
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static UnitEnum|string|null $navigationGroup = 'إدارة النظام';
    protected static ?string $navigationLabel = 'المستخدمين';


    
    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        
        return $table
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('id')
                    ->label('رقم التعريف')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('الدور')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        $map = [
                            'admin'   => 'آدمن',
                            'trainer' => 'مدرب',
                            'member'  => 'متدرب',
                        ];

                        return $map[$state] ?? 'غير معروف';
                    }),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('birth_date')
                    ->label('العمر')
                    ->getStateUsing(function ($record) {
                        if (!$record->birth_date) {
                            return '-';
                        }
                        // Cache the parsed date to avoid re-parsing
                        $birthDate = $record->birth_date instanceof \Carbon\Carbon 
                            ? $record->birth_date 
                            : Carbon::parse($record->birth_date);
                        return $birthDate->age . ' سنة';
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('birth_date', $direction);
                    }),])
                ->actions([
            EditAction::make()->label('تعديل'),
            DeleteAction::make()->label('حذف'),
        ])
        ->bulkActions([
            BulkActionGroup::make([
               DeleteBulkAction::make()->label('حذف جماعي'),
            ]),
        ]);
    }    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
