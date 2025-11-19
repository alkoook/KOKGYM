<?php

namespace App\Filament\Admin\Resources\Programs;

use App\Filament\Admin\Resources\Programs\RelationManagers\ExercisesRelationManager;
use App\Filament\Admin\Resources\Programs\Pages\CreateProgram;
use App\Filament\Admin\Resources\Programs\Pages\EditProgram;
use App\Filament\Admin\Resources\Programs\Pages\ListPrograms;
use App\Filament\Admin\Resources\Programs\Pages\ViewProgram;
use App\Filament\Admin\Resources\Programs\Schemas\ProgramForm;
use App\Filament\Admin\Resources\Programs\Schemas\ProgramsTable;
use App\Models\Program;
use BackedEnum;
use Filament\Actions\ViewAction;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;



use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ProgramResource extends Resource
{


    protected static ?string $model = Program::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static UnitEnum|string|null $navigationGroup = 'إدارة التمارين';
    protected static ?string $navigationLabel = 'البرامج';
    public static function form(Schema $schema): Schema
    {
        return ProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
    return ProgramsTable::configure($table)
             ->defaultPaginationPageOption(25);
            // ->actions([
            // // ✅ إضافة زر العرض
            // ViewAction::make()
            //     ->label('عرض الجدول الأسبوعي'),]);  
              }

 public static function getRelations(): array
{
    return [
        ExercisesRelationManager::class,
    ];
}
      public static function canAccess(): bool
{
    $user = auth()->user();

    // مثال: الأدمن يشوف كلشي، والمدرب بس بعض الواجهات
    return $user && (
        $user->can('manage programs')
    );
}

    public static function getPages(): array
    {
        return [
            'index' => ListPrograms::route('/'),
            'create' => CreateProgram::route('/create'),
            'edit' => EditProgram::route('/{record}/edit'),
            // 'view' => ViewProgram::route('/{record}'),

        ];
    }
}
