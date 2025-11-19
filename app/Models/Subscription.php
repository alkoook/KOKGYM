<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Payment;


class Subscription extends Model
{
    use HasFactory ;
    protected $fillable=['user_id','membership_id','start_date','end_date','is_active'];
        public function user(){
            return $this->belongsTo(User::class);
        }
          public function membership(){
            return $this->belongsTo(MemberShip::class);
        }
        public function payment(){
        return $this->hasMany(Payment::class);
    }

}
