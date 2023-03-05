<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $appoint = Appointment::where('done',1)
                        ->where('bill_id',NULL)
                        ->with('patient')->get();
        $billwithtotal = Bill::with('patient')->get();
        $bills = Bill::with('patient')->get();
        foreach ($bills as $key=>$bill) {
            $sum = Bill::where('id',$bill['id'])->sum(DB::raw('doctor_charge + test_charge + room_charge + medical_charge'));
            $total=$sum+($sum * 0.14);
            $billwithtotal[$key]['total'] =$total;
        }
        return view('dashboard.accounting.invoice.index',[
            'appoint'=>$appoint,
        ]);
    }

    public function finished(){

        $bills = Bill::where('payed',0)->with('patient')->get();
        $billwithtotal = Bill::where('payed',0)->with('patient')->get();
        foreach ($bills as $key=>$bill) {
        $sum = Bill::where('id',$bill['id'])->sum(DB::raw('doctor_charge + test_charge + room_charge + medical_charge'));
        $total=$sum+($sum * 0.14);
        $billwithtotal[$key]->total =$total;
        }
        return view('dashboard.accounting.invoice.finished',[
        'bills'=>$billwithtotal
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = '';
        foreach ($_GET as $key => $value) {
            $id = $key;
        }
        $appoint = Appointment::where('id',$id)->get()->first();
        return view('dashboard.accounting.invoice.create',[
            'appoint'=>$appoint,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appoint = Appointment::find($request['appoint_id']);
        $invoice = Bill::create([
            'patient_id'=>$appoint['patient_id'],
            'appoint_id'=>$request['appoint_id'],
            'doctor_charge'=>$request['doctor'],
            'test_charge'=>$request['test'],
            'medical_charge'=>$request['pharmacy'],
            'room_charge'=>$request['room'],
            'notes'=>$request['notes'],
        ]);
        $appoint['bill_id']=$invoice['id'];
        $appoint->save();
        return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);
        $subtotal = $bill['doctor_charge']+$bill['test_charge']+$bill['room_charge']+$bill['medical_charge'];
        $tax = $subtotal* 0.14;
        $total = $subtotal+$tax;
        return view('dashboard.accounting.invoice.show',[
            'bill'=>$bill,
            'subtotal'=>$subtotal,
            'tax'=>$tax,
            'total'=>$total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);
        $bill['payed']=1;
        $bill->save();
        return redirect('finished');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
