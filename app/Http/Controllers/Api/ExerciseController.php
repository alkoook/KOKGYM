<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Support\Facades\Storage;
use App\Models\User;




class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::with(['creator', 'machine'])->get();
        $result = $exercises->map(function ($ex) {
            return [
                'id' => $ex->id,
                'name' => $ex->name,
                'description' => $ex->description,
                'video_url' => $ex->video ? Storage::disk('exercise')->url($ex->video) : null, // 👈 استخدام Storage::url
                'category' => $ex->category,
                'level' => $ex->level,
                // بيانات الآلة المرتبطة
                'related_machine' => $ex->machine ? $ex->machine->name : 'لا توجد آلة', // 👈 جلب اسم الآلة
                // بيانات من أنشأ التمرين
                'added_by_email' => $ex->creator->email ?? 'N/A',
            ];
        });

        return response()->json($result, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:exercises,name', // 👈 يجب أن يكون فريداً
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,avi,mov|max:20000',
            'category' => 'required|string', // العضلة المستهدفة
            'level' => 'required|in:beginner,intermediate,advanced',
            'machine_id' => 'nullable|exists:machines,id', // 👈 يجب أن يكون nullable
        ]);

        $video = $request->file('video');

        // استخدام التنسيق الآمن للوقت
        $videoName = $request->name . '_' . now()->format('Ymd_His') . '.' . $video->getClientOriginalExtension();
        $disk = 'exercise';

        // خزّن الملف في مسار videos
        $path = $video->storeAs('videos', $videoName, $disk); // 👈 وضع الملف داخل مجلد 'videos'

        if (!$path) {
            return response()->json(['error' => 'فشل في تخزين الفيديو'], 500);
        }

        $exercise = Exercise::create([
            'name' => $request->name,
            'description' => $request->description,
            'video' => $path,
            'category' => $request->category,
            'level' => $request->level,
            'machine_id' => $request->machine_id,
            'user_id' => auth()->id(), // من قام بإضافة التمرين
        ]);

        return response()->json([
            'message' => 'تم إنشاء التمرين بنجاح',
            'exercise' => $exercise,
            'video_url' => Storage::disk($disk)->url($path)
        ], 201);
    }
    public function show($id)
    {
        $exercise = Exercise::where('id', $id)->first();
        if (!$exercise) {
            return response()->json('this is no Exercise like this', 401);
        }
        return response()->json($exercise, 200);
    }

    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        if ($exercise) {
            Storage::disk('exercise')->delete($exercise->video);
            $exercise->delete();
            return response()->json('Exercise is Deleted Succefully', 200);
        }
        return response()->json('Exercise is not Exists', 401);


    }

    public function update(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);
        $request->validate([
            'name' => 'sometimes',
            'description' => 'sometimes',
            'video' => 'sometimes|mimes:mp4,avi,mov|file',
            'level' => 'sometimes',
            'category' => 'sometimes',
        ]);
        $exercise->name = $request->name ?? $exercise->name;
        $exercise->description = $request->description ?? $exercise->description;
        $exercise->level = $request->level ?? $exercise->level;
        $exercise->category = $request->category ?? $exercise->category;
        $exercise->user_id = auth()->user()->id;
        if ($request->hasFile('video')) {
            if ($exercise->video && Storage::disk('exercise')->exists($exercise->video)) {
                Storage::disk('exercise')->delete($exercise->video);
            }
            $video = $request->file('video');
            $video_name = $exercise->name . '_' . now()->format('Ymd-His') . '.' . $video->getClientOriginalExtension();
            $path = Storage::disk('exercise')->putFileAs('videos', $video, $video_name);
            $exercise->video = $path;
        }
        $exercise->save();
        return response()->json($exercise, 200);

    }

    public function createFullProgramForUser(Request $request)
    {
        // 1. التحقق من صحة البيانات العامة والتحقق المبدئي
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'exercises_data' => 'required|array|min:1',
        ]);


        $request->validate([
            // exercise_id يجب أن يكون موجوداً في جدول exercises
            'exercises_data.*.exercise_id' => 'required|exists:exercises,id',
            'exercises_data.*.sets' => 'required|numeric|min:0',
            'exercises_data.*.repetitions' => 'required|numeric|min:0',
            'exercises_data.*.day' => 'required|string',
            'exercises_data.*.activity_type' => 'required|string',
        ]);

        $user = User::findOrFail($request->user_id);
        $trainerId = auth()->id();


        $user->exercises()->detach();

        foreach ($request->exercises_data as $data) {

            $user->exercises()->attach($data['exercise_id'], [
                'sets' => $data['sets'],
                'repetitions' => $data['repetitions'],
                'day' => $data['day'],
                'activity_type' => $data['activity_type'],
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'added_by' => $trainerId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'تم تعيين البرنامج التدريبي بالكامل بنجاح'], 201);
    }



    public function showExercisesForUser($id)
    {
        $user = User::with([
            'exercises' => function ($query) {
                $query->with('machine');
            }
        ])->findOrFail($id);

        $result = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'program' => $user->exercises->map(function ($exercise) {

                $videoUrl = $exercise->video ? Storage::disk('exercise')->url($exercise->video) : null;

                return [
                    'exercise_id' => $exercise->id,
                    'exercise_name' => $exercise->name,
                    'category' => $exercise->category,
                    'level' => $exercise->level,
                    'video_url' => $videoUrl,
                    'machine' => $exercise->machine ? $exercise->machine->name : 'وزن الجسم/لا يوجد آلة',

                    'program_details' => [
                        'sets' => $exercise->pivot->sets,
                        'repetitions' => $exercise->pivot->repetitions,
                        'day' => $exercise->pivot->day,
                        'activity_type' => $exercise->pivot->activity_type,
                        'start_date' => $exercise->pivot->start_date,
                        'end_date' => $exercise->pivot->end_date,
                        'added_by_id' => $exercise->pivot->added_by,
                    ]
                ];
            })
                ->groupBy('program_details.day')
                ->map(function ($dayExercises) {
                    return $dayExercises->map(function ($exercise) {
                        $details = $exercise['program_details'];
                        unset($exercise['program_details']);
                        return array_merge($exercise, $details);
                    });
                })
        ];

        return response()->json($result, 200);
    }
}
