<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bill extends Model
{
    use HasFactory;

    protected $fillable =[
        'patient_id',
        'appoint_id',
        'room_charge',
        'doctor_charge',
        'test_charge',
        'medical_charge',
        'notes',
        'payed'
];
    public function patient()
    {
        return $this->belongsTo(User::class,'patient_id');
    }

    public function scopeSubtotal(){
        $user_id = Auth::user()->id;
        $bills = Bill::where('patient_id',$user_id)->get();
        $billTotal = [];
        foreach ($bills as $key=> $bill) {
            $billTotal[$key]['id'] = $bill['id'];
            $billTotal[$key]['created_at'] = $bill['created_at'];
            $billTotal[$key]['updated_at'] = $bill['updated_at'];
            $billTotal[$key]['payed'] = $bill['payed'];
            $billTotal[$key]['total'] = $bill['room_charge']+$bill['doctor_charge']+$bill['test_charge']+$bill['medical_charge'];
        }
        return $billTotal;
    }

}
