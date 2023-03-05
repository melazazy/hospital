<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// To use in future
class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable =['med_id','trans_quant','trans_type'];

}
