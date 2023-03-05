<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosi extends Model
{
    use HasFactory;
    protected $table ='diagnosis';
    protected $fillable =['doctor_id','patient_id','appoint_id','diagnosing'];
}
