<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator; // 👈 استيراد الواجهة الجديدة
use Carbon\Carbon;

class ProgramController extends Controller
{
    public function store(Request $request)
    {
        // 1. تحديد قواعد التحقق الأساسية
        $rules = [
            'name'          => 'required|string|unique:programs,name', 
            'description'   => 'required|string',
            'days'          => 'required|array|min:1', 
            'days.*.day'    => 'required|integer|between:1,7',
            'days.*.type'   => 'required|in:workout,rest,cardio',
            'days.*.exercises'=> 'nullable|array',
            
            // 🛑 تم تغيير القاعدة هنا لتبسيطها
            'days.*.exercises.*.id'    => 'required_if:days.*.type,workout,cardio|integer|exists:exercises,id',
            'days.*.exercises.*.sets'  => 'nullable|integer|min:0',
            'days.*.exercises.*.reps'  => 'nullable|integer|min:0',
        ];

        // 2. استخدام Validator Facade يدوياً
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $programData = $validator->validated();

        // 3. إنشاء البرنامج (بقية المنطق كما هو)
        $program = Program::create([
            'name' => $programData['name'],
            'description' => $programData['description'],
            'created_by' => auth()->id(),
        ]);

        $attachments = [];
        $restDayId = 10000; 

        foreach ($programData['days'] as $dayData) {
            if ($dayData['type'] === 'rest') {
                $attachments[] = [
                    'program_id'    => $program->id,
                    'exercise_id'   => $restDayId,
                    'day'           => $dayData['day'],
                    'type'          => 'rest',
                    'sets'          => 0, 
                    'reps'          => 0,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            } else {
                if (!empty($dayData['exercises'])) {
                    foreach ($dayData['exercises'] as $ex) {
                        $attachments[] = [
                            'program_id'    => $program->id,
                            'exercise_id'   => $ex['id'],
                            'day'           => $dayData['day'],
                            'type'          => $dayData['type'],
                            'sets'          => $ex['sets'] ?? null,
                            'reps'          => $ex['reps'] ?? null,
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ];
                    }
                }
            }
        }
        
        if (!empty($attachments)) {
            DB::table('program_exercise')->insert($attachments);
        }

        return response()->json([
            'message' => 'تم إنشاء البرنامج بنجاح كقالب عام.',
            'program' => $program
        ], 201);
    }


public function index()
{
    $programs = Program::with(['exercises' => function ($query) {
        $query->withPivot('day', 'type', 'sets', 'reps');
    }])->get();

    $programsWithSchedule = $programs->map(function ($program) {
        
        $groupedSchedule = $program->exercises
            ->groupBy('pivot.day')
            ->map(function ($dayExercises, $dayNumber) {
                
                $dayType = $dayExercises->first()->pivot->type;

                $exercises = $dayExercises
                    ->filter(fn($ex) => $ex->id !== 10000)
                    ->map(function ($ex) {
                        return [
                            'id'    => $ex->id,
                            'name'  => $ex->name,
                            'sets'  => (int)$ex->pivot->sets, 
                            'reps'  => (int)$ex->pivot->reps,
                        ];
                    })->values(); 

                return [
                    'day_number' => $dayNumber,
                    'type'       => $dayType,
                    'exercises'  => $exercises,
                ];
            })->values();

        $programArray = $program->toArray();
        $programArray['schedule'] = $groupedSchedule;
        unset($programArray['exercises']);

        return $programArray;
    });

    return response()->json($programsWithSchedule, 200);
}

    public function show($id)
    {
        $program = Program::with(['exercises' => function ($query) {
            $query->withPivot('day', 'type', 'sets', 'reps');
        }])->findOrFail($id);
        
        $groupedSchedule = $program->exercises
            ->groupBy('pivot.day')
            ->map(function ($dayExercises, $dayNumber) {
                $dayType = $dayExercises->first()->pivot->type;

                $exercises = $dayExercises
                    ->filter(fn($ex) => $ex->id !== 10000)
                    ->map(function ($ex) {
                        return [
                            'id'    => $ex->id,
                            'name'  => $ex->name,
                            'sets'  => (int)$ex->pivot->sets,
                            'reps'  => (int)$ex->pivot->reps,
                        ];
                    })->values();

                return [
                    'day_number' => $dayNumber,
                    'type'       => $dayType,
                    'exercises'  => $exercises,
                ];
            })->values();

        return response()->json([
            'id' => $program->id,
            'name' => $program->name,
            'description' => $program->description,
            'schedule' => $groupedSchedule
        ], 200);
    }
    
public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        // 1. تحديد قواعد التحقق
        $rules = [
            'name'          => ['required', 'string', Rule::unique('programs')->ignore($program->id)], 
            'description'   => 'required|string',
            'days'          => 'required|array|min:1', 
            'days.*.day'    => 'required|integer|between:1,7',
            'days.*.type'   => 'required|in:workout,rest,cardio',
            'days.*.exercises'=> 'nullable|array',
            
            // 🛑 التصحيح الذي عالج مشكلة الـ Validation في يوم الراحة
            'days.*.exercises.*.id'    => [
                'nullable', // 👈 للسماح بأن يكون الحقل null/غير موجود في حالة الراحة
                'required_if:days.*.type,workout,cardio', 
                'integer', 
                'exists:exercises,id'
            ],
            
            'days.*.exercises.*.sets'  => 'nullable|integer|min:0',
            'days.*.exercises.*.reps'  => 'nullable|integer|min:0',
        ];

        // 2. تطبيق التحقق يدوياً
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $programData = $validator->validated();
        
        // 3. تحديث بيانات البرنامج الأساسية
        $program->update([
            'name' => $programData['name'],
            'description' => $programData['description'],
        ]);
        
        // 4. 🛑 الحذف أولاً: إزالة جميع التمارين القديمة المرتبطة بهذا البرنامج
        DB::table('program_exercise')->where('program_id', $program->id)->delete();
        
        // 5. تجميع بيانات التمارين الجديدة
        $attachments = [];
        $restDayId = 10000;
        
        foreach ($programData['days'] as $dayData) {
             if ($dayData['type'] === 'rest') {
                $attachments[] = [
                    'program_id'    => $program->id,
                    'exercise_id'   => $restDayId,
                    'day'           => $dayData['day'],
                    'type'          => 'rest',
                    'sets'          => 0, 
                    'reps'          => 0,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            } else {
                if (!empty($dayData['exercises'])) {
                    foreach ($dayData['exercises'] as $ex) {
                        $attachments[] = [
                            'program_id'    => $program->id,
                            'exercise_id'   => $ex['id'],
                            'day'           => $dayData['day'],
                            'type'          => $dayData['type'],
                            'sets'          => $ex['sets'] ?? null,
                            'reps'          => $ex['reps'] ?? null,
                            'created_at'    => now(),
                            'updated_at'    => now(),
                        ];
                    }
                }
            }
        }
        
        // 6. الإدخال: إضافة جميع التمارين الجديدة (Batch Insert)
        if (!empty($attachments)) {
            DB::table('program_exercise')->insert($attachments);
        }

        return response()->json(['message' => 'تم تحديث البرنامج بنجاح'], 200);
    }
    
    public function destroy($id)
    {
       $program = Program::findOrFail($id);
       $program->delete();
       return response()->json('Program is Deleted', 200);
    }
}