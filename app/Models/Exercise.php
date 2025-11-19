<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Machine;



class Exercise extends Model
{
    protected $fillable=['name','description','video','category','level','user_id','machine_id'];
    public function users(){
    return $this->belongsToMany(User::class, 'program_assignments', 'exercise_id', 'user_id')
                    ->withPivot(['sets', 'repetitions', 'day', 'activity_type', 'start_date', 'end_date', 'added_by'])
                    ->withTimestamps();    }
    public function machine(){
        return $this->belongsTo(Machine::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id'); // يستخدم حقل user_id في جدول exercises
    }
public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_exercise')
            ->withPivot('day', 'type', 'sets', 'reps')
            ->withTimestamps();
    }

}
