<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $table = 'labs';
    protected $fillable =[
        'appoint_id',
        'tests',
        'results',
        'done'
    ];

    public function appoint()
    {
        return $this->belongsTo(Appointment::class);
    }
}
