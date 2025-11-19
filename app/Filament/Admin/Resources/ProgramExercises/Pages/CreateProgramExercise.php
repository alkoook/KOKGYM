<?php

namespace App\Filament\Admin\Resources\ProgramExercises\Pages;

use App\Filament\Admin\Resources\ProgramExercises\ProgramExerciseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProgramExercise extends CreateRecord
{
    protected static string $resource = ProgramExerciseResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // 1. استخلاص البيانات المعقدة
        $programId = $data['program_id'];
        $exercisesData = $data['exercises'] ?? [];
        
        // 2. نحتاج موديل البرنامج للعلاقة
        $program = \App\Models\Program::find($programId);

        if (!$program) {
             // يمكن التعامل مع خطأ عدم وجود البرنامج هنا
             return $program; 
        }

        // 3. (اختياري) مسح أي تمارين قديمة لهذا البرنامج قبل إعادة بنائه
        $program->exercises()->detach();

        foreach ($exercisesData as $dayGroup) {
            $day = $dayGroup['day'];
            $type = $dayGroup['type'];
            
            foreach ($dayGroup['items'] ?? [] as $exerciseItem) {
                
                // استخدام attach لحفظ العلاقة مع بيانات الـ Pivot
                if (isset($exerciseItem['exercise_id'])) {
                    $program->exercises()->attach($exerciseItem['exercise_id'], [
                        'day' => $day,
                        'type' => $type, // يوم التمرين
                        'sets' => $exerciseItem['sets'] ?? null,
                        'reps' => $exerciseItem['reps'] ?? null,
                    ]);
                }
            }
            
            if ($type === 'rest') {
            }
        }
        
        return $program;
    }
    
    protected function getRedirectUrl(): string
    {
        return  ProgramExerciseResource::getUrl('index');
    }
 
}
