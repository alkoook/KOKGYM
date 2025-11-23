<?php
// app/Models/Program.php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'assign_to'
    ];
    // تم إزالة weekly_schedule من $appends لتجنب تحميله تلقائياً في كل استعلام
    // يمكن الوصول إليه مباشرة عند الحاجة: $program->weekly_schedule
    
    // علاقة Many-to-Many مع التمارين (Exercises)
 public function exercises()
{
    return $this->belongsToMany(\App\Models\Exercise::class, 'program_exercise')
        ->withPivot(['day', 'type', 'sets', 'reps'])
        ->orderBy('program_exercise.day');
}
public function programExercises()
{
    return $this->hasMany(ProgramExercise::class);
}

   public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }
    
    // المدرب الذي أنشأ البرنامج
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

public function getWeeklyScheduleAttribute()
{
    // تحميل التمارين فقط عند الحاجة (lazy loading)
    if (!$this->relationLoaded('exercises')) {
        $this->load('exercises');
    }
    
    return $this->exercises->map(function ($exercise) {
        return [
            'day' => $exercise->pivot->day,
            'name' => $exercise->name, 
            'sets' => $exercise->pivot->sets,
            'reps' => $exercise->pivot->reps,
            'type' => $exercise->pivot->type,
        ];
    })->values();
}
    protected function modifyQueryForView(Builder $query): Builder
{
    // تحميل علاقة التمارين (exercises) مسبقًا مع تحميل كائن التمرين نفسه (name)
    return $query->with('exercises'); 
}
}