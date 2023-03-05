<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\User_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medicine.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $med_name =Medicine::where('name',$request->input('name'))->first();
        $med_code =Medicine::where('code',$request->input('code'))->first();
        // check if Medicine name Found
        if($med_name){
            $msg = 'Medicine '.$request->input('name').' Already Founde';
            return redirect('/dashboard')->with('msg',$msg);
        }
        else{
            if ($med_code) {
                $msg = 'Code '.$request->input('code').' Already Founde Add New Code';
                return redirect('/dashboard')->with('msg',$msg);
            }
            else{
                $medicine = Medicine::create([
                    'name' =>$request->input('name'),
                    'code' =>$request->input('code'),
                    'Medicine_price' =>$request->input('price'),
                    'start_quantity' =>$request->input('quantity'),
                    'limit_quant' =>$request->input('limit'),
                ]);
                $msg = 'Medicine '.$request->input('name').' Add to Database With Id: '.$medicine['id'];
                return redirect()->back()->with('msg',$msg);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
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
        $medicine=Medicine::find($id) ?? Medicine::where('name',$request->input('name'))->first();
        $medicine['name'] =$request->input('name');
        $medicine['code'] =$request->input('code');
        $medicine['Medicine_price'] =$request->input('price');
        $medicine['start_quantity'] =$request->input('quantity');
        $medicine['limit_quant'] =$request->input('limit');
        $medicine->save();
        return redirect()->back()->with('msg','Medicine Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $medicine=Medicine::find($id) ?? Medicine::where('name',$request->input('name'))->first();
        $medicine->delete();
        return redirect()->back()->with('error','Medicine Deleted');

    }
    public function managemedic(Request $request)
    {
        $user_id = Auth::user()->id;
        $doc = User_detail::where('user_id',$user_id)->first();
        $msg = '';
        if($doc['department_id'] == 16){
            if ($request['action'] == 'add') {
                $this->store($request);
            }
            elseif($request['action'] == 'update'){
                $id = $request['id'];
                $this->update($request,$id);

            }
            elseif($request['action'] == 'delete'){
                $id = $request['id'];
                $this->destroy($request,$id);

            }
            else{
                return redirect('/dashboard');
            }
        }
        else
        {
            $msg = 'Error !! You do Not have permession';
            return redirect()->back()->with('msg',$msg);
        }

        return redirect()->back();
    }

}
