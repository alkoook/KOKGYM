<?php

namespace App\Filament\Admin\Resources\ProgramExercises\Schemas;

use App\Models\Exercise;
use App\Models\Program;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Schemas\Schema;
class ProgramExerciseForm
{
public static function configure(Schema $schema): Schema    {
        return $schema->schema([
            // 1. اختيار البرنامج (لأنه Resource منفصل)
            Select::make('program_id')
                ->label('البرنامج المراد بناء جدول له')
                ->searchable()
                ->options(Program::pluck('name','id'))
                ->required(),

            // 2. Repeater الخارجي (اليوم/النشاط)
            Repeater::make('exercises') // الاسم الذي سنستخدمه في منطق الحفظ
                ->label('تقسيم البرنامج الأسبوعي')
                ->schema([
                    Select::make('day')
                        ->label('اليوم')
                        ->options([1=>'الأحد', 2=>'الإثنين', 3=>'الثلاثاء', 4=>'الأربعاء', 5=>'الخميس', 6=>'الجمعة', 7=>'السبت'])
                        ->required(),
                    
                    Select::make('type')
                        ->label('نوع اليوم')
                        ->options(['workout' => 'تمرين', 'rest' => 'راحة', 'cardio' => 'كارديو'])
                        ->required(),

                    // 3. Repeater الداخلي (التمارين الفعلية)
                    Repeater::make('items') // الاسم الذي سنستخدمه في منطق الحفظ
                        ->label('التمارين لهذا اليوم')
                        ->schema([
                            Select::make('exercise_id') // الحقل الذي يحتوي الـ ID
                                ->label('اختر التمرين')
                                ->options(Exercise::pluck('name','id'))
                                ->required(),

                            TextInput::make('sets')
                                ->label('الجولات')
                                ->numeric() 
                                ->required(),

                            TextInput::make('reps')
                                ->label('التكرارات')
                                ->numeric()
                                ->required(),
                        ])
                        ->columns(3)
                        // ✅ إخفاء تمارين اليوم إذا كان نوع اليوم 'راحة'
                        ->visible(fn (array $state) => ($state['type'] ?? 'workout') !== 'rest'),
                ]) 
                ->collapsible()
                
        ])->columns(1);
    }
}

