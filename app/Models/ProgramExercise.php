<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramExercise extends Model
{
    protected $table='program_exercise';
    protected $fillable=['program_id','exercise_id','day','sets','reps'];
    public function exercise()
        {
            return $this->belongsTo(Exercise::class);
        }
    public function program()
        {
            return $this->belongsTo(Program::class);
        }
     }
