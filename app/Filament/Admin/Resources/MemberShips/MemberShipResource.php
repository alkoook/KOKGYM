<?php

namespace App\Filament\Admin\Resources\MemberShips;

use App\Filament\Admin\Resources\MemberShips\Pages\CreateMemberShip;
use App\Filament\Admin\Resources\MemberShips\Pages\EditMemberShip;
use App\Filament\Admin\Resources\MemberShips\Pages\ListMemberShips;
use App\Filament\Admin\Resources\MemberShips\Schemas\MemberShipForm;
use App\Filament\Admin\Resources\MemberShips\Tables\MemberShipsTable;
use App\Models\MemberShip;
use Filament\Actions\ActionGroup;
use Filament\Schemas\Schema;
use UnitEnum; // هذا ضروري
use BackedEnum; // هذا ضروري
// تم تبسيط وتجميع الـ Imports
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn; // تم إضافة IconColumn لاستخدامها مع الـ Toggle
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;


class MemberShipResource extends Resource
{
      public static function canAccess(): bool
{
    $user = auth()->user();

    // مثال: الأدمن يشوف كلشي، والمدرب بس بعض الواجهات
    return $user && (
        $user->hasRole('admin')
    );
}
    protected static ?string $model = MemberShip::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;
    protected static UnitEnum|string|null $navigationGroup  = 'إدارة الاشتراكات';

    protected static ?string $navigationLabel = 'العضويات';

    public static function form(Schema $schema): Schema
    {
        return MemberShipForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberShipsTable::configure($table)
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
            'index' => ListMemberShips::route('/'),
            'create' => CreateMemberShip::route('/create'),
            'edit' => EditMemberShip::route('/{record}/edit'),
        ];
    }
}