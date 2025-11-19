<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    protected $table='memberships';
    protected $fillable=['name', 'duration_days','price','is_active'];
}
