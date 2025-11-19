<?php

namespace App\Filament\Admin\Resources\ProgramExercises\Tables;

use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class ProgramExercisesTable
{
}
//     public static function configure(Table $table): Table
//     {
//         return $table
//             ->columns([
//                 TextColumn::make('program.name')
//                     ->label('البرنامج')
//                     ->sortable()
//                     ->searchable(),

//                 TextColumn::make('exercise.name')
//                     ->label('التمرين')
//                     ->sortable()
//                     ->searchable(),

//                 TextColumn::make('day')
//                     ->label('اليوم'),

//                 TextColumn::make('type')
//                     ->label('النوع'),

//                 TextColumn::make('sets')
//                     ->label('الجولات'),

//                 TextColumn::make('reps')
//                     ->label('التكرارات'),

//                 TextColumn::make('created_at')
//                     ->label('تاريخ الإضافة')
//                     ->dateTime()
//                     ->sortable(),
//             ])
//             ->actions([
//                 Action::make('عرض التفاصيل')
//                     ->label('عرض')
//                     ->icon('heroicon-o-eye')
//                     ->color('info')
//                     ->url(fn($record) => route('filament.admin.resources.program-exercises.view', ['record' => $record])),
//             ])
//             ->bulkActions([]);
//     }
// }
