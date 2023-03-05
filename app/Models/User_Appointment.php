<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Appointment extends Model
{
    use HasFactory;
    protected $table = 'user_appointments';
    protected $fillable=['patient_id','department_id','doctor_id','appoint-date','appoint-time','notes','accepted'];

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }
}
