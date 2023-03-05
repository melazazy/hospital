<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'prescriptions';

    protected $fillable =['appoint_id','prescription','charge','pay'];

    public function appoint()
    {
        return $this->belongsTo(Appointment::class,'appoint_id');
    }
}
