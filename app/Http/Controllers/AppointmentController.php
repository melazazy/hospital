<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();
        $departments = Department::limit(13)->get();

        return view('appointments.index',[
            'departments'=>$departments,
            'appointments'=>$appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create([
            'doctor_id' =>$request->input('doctorId'),
            'department_id' =>$request->input('departmentId'),
            'appoint_date' =>$request->input('appoint_date'),
            'appoint_time' =>$request->input('appoint_time')
        ]);
        $id = Auth::user()->id;
        $appointments = Appointment::all()->where('doctor_id',$id);
        $msg = 'Error !!';
        if ($appointment) {
            $msg ='Appointment was Created!!';
        }
        return redirect()->back()->with('msg',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointments = Appointment::where('department_id',$id)->where('is_token',0)->with('doctor','patient')->orderBy('appoint_date', 'desc')->get();
        $department = Department::find($id)->department_name;
        return view('appointments.show',[
            'appointments' =>  $appointments,
            'department'=>$department,
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // $appoint_id = $id;
        // if ($id == 'test') {
        $appoint_id = $request->input('appoint_id');
        $appointment = Appointment::find($appoint_id);
        $appointment['patient_id']=$request->input('patient_id');
        $appointment['is_token']=1;
        $appointment->save();
        return redirect()->back()->with('msg','Appointment Booked');
        // return $this->show($department_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del =  Appointment::find($id);
        $del->delete();
        return redirect()->back();
    }
}
