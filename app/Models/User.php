<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ← لازم تستوردها
use Spatie\Permission\Traits\HasRoles;
use App\Models\Attendance;
use App\Models\Exercise;




class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasApiTokens;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'phone',
        'photo',
        'trainer_id',
        'uid',
        'weight',
        'height'
    ];
      public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
    public function members(){
        return $this->hasMany(User::class,'trainer_id');
    }
    public function tariner(){
        return $this->belongsTo(User::class,'trainer_id');
    }
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'program_assignments', 'user_id', 'exercise_id')
                    ->withPivot(['sets', 'repetitions', 'day', 'activity_type', 'start_date', 'end_date', 'added_by'])
                    ->withTimestamps();
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}