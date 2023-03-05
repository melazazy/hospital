<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Diagnosi;
use App\Models\Lab;
use App\Models\Prescription;
use App\Models\User_Appointment;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function appoints()
    {
        $user_id = Auth::user()->id;
        $appointments = Appointment::where('patient_id',$user_id)->get();
        $reqappoints = User_Appointment::where('patient_id',$user_id)->get();
        return view('dashboard.patient.appoints',[
            'appointments'=>$appointments,
            'reqappoints'=>$reqappoints,
        ]);
    }
    public function prescription()
    {
        $user_id = Auth::user()->id;
        $prescriptions = Prescription::whereHas('appoint',function($q) use($user_id) {
            $q->where('patient_id',$user_id);
        })->get();
        return view('dashboard.patient.prescription',[
            'prescriptions'=>$prescriptions,
        ]);
    }
    public function preshow($id)
    {
        $user_id = Auth::user()->id;
        $prescription = Prescription::find($id);
        $pre = Prescription::where('id',$id)->with('appoint')->get()->first();
        $pres = explode(',',$pre['prescription']);
        $ppr=[];
        foreach ($pres as $value) {
            if (str_contains($value, 'Code')) {
                preg_match('/Code(.*)/',$value, $match);
                $ppr[]=$match[1];
            }
        }
        if (count($ppr)<1) {
            $ppr = $pres;
        }
        return view('dashboard.patient.preshow',[
            'prescription'=>$prescription,
            'pres'=>$ppr,
        ]);
    }
    public function bills()
    {
        $user_id = Auth::user()->id;
        $bills = Bill::where('patient_id',$user_id)->subtotal();
        return view('dashboard.patient.bills',[
            'bills'=>$bills,
        ]);
    }
    public function diagnosing($id)
    {
        $user_id = Auth::user()->id;
        $diagnosis = Diagnosi::where('patient_id',$user_id)->where('appoint_id',$id)->get();
        return view('dashboard.patient.diagnosis',[
            'diagnosis'=>$diagnosis,
        ]);
    }
    public function tests()
    {
        $user_id = Auth::user()->id;
        $tests = Lab::whereHas('appoint',function($q) use($user_id) {
            $q->where('patient_id',$user_id);
        })->where('done',1)->get();
        $test_arr=[];
        $result_arr=[];
        $all=[];
        if ($tests->isNotEmpty() ) {
            foreach ($tests as $value) {
                $test_arr[] = explode(',',$value['tests']) ;
                $result_arr[] = explode(',',$value['results']) ;
            }
            $all = array_combine($test_arr[0],$result_arr[0]);
        }
        return view('dashboard.patient.test',[
            'tests'=>$all,
        ]);
    }
}
