<?php
namespace App\Filament\Admin\Resources\Programs\RelationManagers;   
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExercisesRelationManager extends RelationManager
{
    protected static string $relationship = 'programExercises';
    protected static ?string $title = 'التمارين ضمن البرنامج';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('exercise_id')
                    ->label('التمرين')
                    ->relationship('exercise', 'name')
                    ->required(),
                Select::make('day')
                    ->label('اليوم')
                    ->options([
                        1 => 'الأحد',
                        2 => 'الاثنين',
                        3 => 'الثلاثاء',
                        4 => 'الأربعاء',
                        5 => 'الخميس',
                        6 => 'الجمعة',
                        7 => 'السبت',
                    ])
                    ->required(),
                TextInput::make('sets')
                    ->label('الجولات')
                    ->numeric()
                    ->required(),
                TextInput::make('reps')
                    ->label('التكرارات')
                    ->numeric()
                    ->required(),
                Select::make('type')
                    ->label('نوع التمرين')
                    ->options([
                        'workout' => 'تمرين',
                        'rest' => 'راحة',
                        'cardio' => 'كارديو',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('exercise.name')->label('اسم التمرين'),
              TextColumn::make('day')
                    ->label('اليوم')
                    ->formatStateUsing(fn($state) => match((int)$state) {
                        1 => 'الأحد',
                        2 => 'الاثنين',
                        3 => 'الثلاثاء',
                        4 => 'الأربعاء',
                        5 => 'الخميس',
                        6 => 'الجمعة',
                        7 => 'السبت',
                        default => 'غير محدد',
                    }),
                TextColumn::make('type')->label('النوع'),
                TextColumn::make('sets')->label('الجولات'),
                TextColumn::make('reps')->label('التكرارات'),
            ])
            ->defaultSort('day', 'asc')
            ->actions([
                EditAction::make()->label('تعديل'),
                DeleteAction::make()->label('حذف'),
            ])
            ->bulkActions([
                DeleteBulkAction::make()->label('حذف المحددين'),
            ]);
    }
}
