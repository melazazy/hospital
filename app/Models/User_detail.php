<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'department_id',
        'full_name',
        'birthday',
        'gender',
        'phone',
        'address',
        'profile_photo_path',
        'is_in',
        'approval',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function appoints(){
        return $this->belongsTo(Appointment::class);
    }
}
