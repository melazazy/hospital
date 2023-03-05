<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'description',
        'department_photo_path'
    ];

    protected $attributes = array(
        'department_name'  => 'NULL',
    );


    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function department(){
        return $this->hasMany(User_detail::class);
    }
}
