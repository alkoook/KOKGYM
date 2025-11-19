<?php

namespace App\Filament\Admin\Resources\Exercises;

use App\Filament\Admin\Resources\Exercises\Pages\CreateExercise;
use App\Filament\Admin\Resources\Exercises\Pages\EditExercise;
use App\Filament\Admin\Resources\Exercises\Pages\ListExercises;
use App\Filament\Admin\Resources\Exercises\Schemas\ExerciseForm;
use App\Filament\Admin\Resources\Exercises\Tables\ExercisesTable;
use App\Models\Exercise;
use BackedEnum;
use UnitEnum;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;
 protected static UnitEnum|string|null $navigationGroup = 'إدارة التمارين';
    protected static ?string $navigationLabel = 'التمارين';
    public static function form(Schema $schema): Schema
    {
        return ExerciseForm::configure($schema);
    }
          public static function canAccess(): bool
{
    $user = auth()->user();

    // مثال: الأدمن يشوف كلشي، والمدرب بس بعض الواجهات
    return $user && (
        $user->can('manage exercises')
    );
}

    public static function table(Table $table): Table
    {
        return ExercisesTable::configure($table)
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
            'index' => ListExercises::route('/'),
            'create' => CreateExercise::route('/create'),
            'edit' => EditExercise::route('/{record}/edit'),
        ];
    }
}
