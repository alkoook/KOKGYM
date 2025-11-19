<?php

namespace App\Filament\Admin\Resources\Supplements;

use App\Filament\Admin\Resources\Supplements\Pages\CreateSupplement;
use App\Filament\Admin\Resources\Supplements\Pages\EditSupplement;
use App\Filament\Admin\Resources\Supplements\Pages\ListSupplements;
use App\Filament\Admin\Resources\Supplements\Schemas\SupplementForm;
use App\Filament\Admin\Resources\Supplements\Tables\SupplementsTable;
use App\Models\Supplement;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SupplementResource extends Resource
{
    protected static ?string $model = Supplement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBeaker;
    protected static UnitEnum|string|null $navigationGroup = 'إدارة المكملات';
    protected static ?string $navigationLabel = 'المكملات';
    public static function form(Schema $schema): Schema
    {
        return SupplementForm::configure($schema);
    }

          public static function canAccess(): bool
{
    $user = auth()->user();

    // مثال: الأدمن يشوف كلشي، والمدرب بس بعض الواجهات
    return $user && (
        $user->can('manage supplements')
    );
}
    public static function table(Table $table): Table
    {
        return SupplementsTable::configure($table)
            ->defaultPaginationPageOption(25);
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
            'index' => ListSupplements::route('/'),
            'create' => CreateSupplement::route('/create'),
            'edit' => EditSupplement::route('/{record}/edit'),
        ];
    }
}
