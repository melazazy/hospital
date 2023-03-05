<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable =[
        'doctor_id',
        'patient_id',
        'department_id',
        'bill_id',
        'appoint_date',
        'appoint_time',
        'is_token',
        'charges_text',
        'done'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function users()
    {
        return $this->belongsTo(User_detail::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function tests(){
        return $this->belongsTo(Lab::class);
    }
}
