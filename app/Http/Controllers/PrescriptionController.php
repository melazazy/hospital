<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Medicine;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{

    public function index()
    {
        $pres = Prescription::where('pay','0')->with('appoint')->get();
        return view('dashboard.prescription.index',[
            'pres'=>$pres,
        ]);
    }
    public function create()
    {
        // return view('appointments.create');
        return view('dashboard.prescription.create');
    }

    public function store(Request $request)
    {
        // Create array for Medicans from input
        $id=$request->input('id');
        $med=$request->input('medicine');
        $repeat=$request->input('repeat');
        $days=$request->input('days');
        $newArr = array_map(function($item0,$item1, $item2, $item3){
            $day = $item3 > 1 ?'Days':'Day';
            return $item0.' Code '. $item1.' Repeating '. $item2.' Times in a day For ' .$item3.' '.$day;
        },$id, $med, $repeat, $days);
        $pre = implode(', ',$newArr);
        Prescription::create([
            'appoint_id' => $request->input('appoint_id'),
            'prescription' => $pre
        ]);
        return redirect('/dashboard');
    }

    public function show($id)
    {
        $pre = Prescription::where('id',$id)->with('appoint')->get()->first();
        $pres = explode(',',$pre['prescription']);
        $text=[];
        foreach ($pres as $value) {
            $text[]= substr($value, strpos($value, ' Code') + 5);
        }
        $medics=[];
        foreach ($pres as  $value) {
            $code= trim(explode('Code',$value)[0]);
            preg_match('/Code(.*?) Repeating/',$value, $match);
            $medics[$code]=$match[1];

        }
        return view('dashboard.prescription.show',[
            'pre'=>$pre,
            'text'=>$text,
            'medics'=>$medics
        ]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $trans_type = $request['type'];
        if ($trans_type == 'pull') {
            $transactions = array_combine($request['key'],$request['count']);
            foreach ($transactions as $key => $value) {
                Transaction::create([
                    'med_id'=> $key,
                    'trans_quant'=>$value,
                    'trans_type'=>0
                ]);
            }
            foreach ($transactions as $key => $value) {
                $med = Medicine::find($key);
                $startval = $med['start_quantity'];
                $med['start_quantity'] = $startval - $value;
                $med->save();
            }
            $pre = Prescription::find($id);
            $pre['charge']=$request['charge'];
            $pre['pay']=1;
            $pre->save();
            $app = Appointment::find($pre['appoint_id']);
            $app['charges_text'].='Pharmacy Charge: '.$request['charge'].' $';
            $app->save();
    }
        return redirect('/dashboard');
    }

    public function destroy($id)
    {
    }
}
