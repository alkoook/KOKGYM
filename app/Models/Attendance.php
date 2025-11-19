<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;



class Attendance extends Model
{
    use HasFactory ;
    protected $fillable=['user_id','subscription_id','check_in_time','check_out_time','status','created_at','updated_at'];
    public function member(){
        return $this->belongsTo(User::class,'user_id');
    }
}
