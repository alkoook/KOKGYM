<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Supplement extends Model
{
    protected $fillable=['name','description','purpose','image','quantity','type','purchase_price','sale_price','origin_country','usage','created_at','updated_at'];
      public function payments(){
        return $this->hasMany(Payment::class);
    }
}