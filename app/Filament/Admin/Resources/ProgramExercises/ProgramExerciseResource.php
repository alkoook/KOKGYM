<?php

namespace App\Filament\Admin\Resources\ProgramExercises;

use App\Filament\Admin\Resources\ProgramExercises\Pages\CreateProgramExercise;
use App\Filament\Admin\Resources\ProgramExercises\Pages\EditProgramExercise;
// use App\Filament\Admin\Resources\ProgramExercises\Pages\ListProgramExercises;
use App\Filament\Admin\Resources\ProgramExercises\Schemas\ProgramExerciseForm;
use App\Filament\Admin\Resources\ProgramExercises\Tables\ProgramExercisesTable;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Forms\Form;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use App\Models\ProgramExercise;


class ProgramExerciseResource extends Resource
{
    protected static ?string $model = ProgramExercise::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlusCircle;
    protected static UnitEnum|string|null $navigationGroup = 'إدارة التمارين';
    protected static ?string $navigationLabel = 'تمارين البرامج';
    public static function form(Schema $schema): Schema    {
        return ProgramExerciseForm::configure($schema);
    }
      public static function canAccess(): bool
{
    $user = auth()->user();

    // مثال: الأدمن يشوف كلشي، والمدرب بس بعض الواجهات
    return $user && (
        $user->can('manage programs')
    );
}

    public static function table(Table $table): Table
    {
        return ProgramExercisesTable::configure($table);
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
            'index' => CreateProgramExercise::route('/'),
            'create' => CreateProgramExercise::route('/create'),
            'edit' => EditProgramExercise::route('/{record}/edit'),

        ];
    }
}
