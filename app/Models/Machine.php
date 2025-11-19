<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Exercise;

class Machine extends Model
{
    protected $fillable = [
        'name',
        'origin_country',
        'image',
        'price',
        'created_at',
        'updated_at'
    ];
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function exercises(){
        return $this->hasMany(Exercise::class);
    }
    
}
