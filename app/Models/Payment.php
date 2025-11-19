<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Machine;
use App\Models\Supplement;

class Payment extends Model
{
    use HasFactory ;
    protected $fillable=['user_id','subscription_id','supplement_id','machine_id','amount','payment_date','payment_method','type','notes'];
    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }
    public function machine(){
        return $this->belongsTo(Machine::class);
    }
    public function supplement(){
        return $this->belongsTo(Supplement::class);
    }
     public function user(){
        return $this->belongsTo(User::class);
    }
}
