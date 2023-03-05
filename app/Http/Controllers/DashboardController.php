<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Department;
use App\Models\Diagnosi;
use App\Models\Lab;
use App\Models\Medicine;
use App\Models\Message;
use App\Models\Prescription;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\User_Appointment;
use App\Models\User_detail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){

        $user_id = Auth::user()->id;
        $user = Auth::user()->type;
        $count = Message::where('to_u_id',$user_id)->where('isRead',0)->count();
        if ($user =='admin') {
            $total=[];
            $type=['admin','doctor','patient','employee'];
            foreach ($type as $value) {
                $total[ucfirst($value)]=
                [User::where('type',$value)->count(),
                User::where('type',$value)->where('last_seen','>=',Carbon::now()->subMinutes(10))->count()];
            }
            $allrooms = Room::all()->count();
            $emptyrooms = Room::where('status',0)->count();
            $rooms=['allrooms'=>$allrooms,'emptyrooms'=>$emptyrooms];
            $charges=[];
            $type = ['room_charge','doctor_charge','medical_charge','test_charge'];
            foreach ($type as  $value) {
                $charges[$value]=Bill::all()->sum($value);
            }
            return view('dashboard.index',[
                'total' =>$total,
                'rooms'=>$rooms,
                'charges'=>$charges,
                'count'=>$count
            ]);
        }
        elseif ($user =='doctor') {
            $type = User_detail::where('user_id',$user_id)->first();
            $doctor = [];
            $app_id=[];
            if ($type['department_id'] == 23) {
                $ttests = Lab::all()->count();
                $rtests = Lab::where('done',0)->count();
                $ftests = Lab::where('done',1)->count();
                return view('dashboard.index',[
                    'data' =>'doctor',
                    'ttests'=>$ttests,
                    'ftests'=>$ftests,
                    'rtests'=>$rtests,
                ]);
            }
            if ($type['department_id'] == 16) {
                $tmedic = Medicine::all()->count();
                $lmedic = Medicine::whereColumn('start_quantity','<=','limit_quant')->count();
                $pres = Prescription::where('charge',0)->count();
                return view('dashboard.index',[
                    'data' =>'doctor',
                    'tmedic'=>$tmedic,
                    'lmedic'=>$lmedic,
                    'pres'=>$pres,
                ]);
            }

            $appoints = Appointment::where('doctor_id',$user_id)->get();
            foreach ($appoints as $value) {
                $app_id[]=$value['id'];
            }
            $total_appoints =$appoints->count();
            $booked_appoints = $appoints->where('is_token',1)->count();
            $done_appoints = $appoints->where('charges_text','!=','')->count();
            $appoint_req = User_Appointment::where('doctor_id',$user_id)->where('accepted',0)->with('patient')->count();
            $patients = Appointment::where('doctor_id',$user_id)->where('done',1)->with('patient')
                                    ->where('patient_id','!=','null')->select('patient_id')->distinct()->limit(10)->get();
            $charges = Bill::whereIn('appoint_id',$app_id)->sum('doctor_charge');
            $bills = Bill::whereIn('appoint_id',$app_id)->get();
            $doctor=['total_appoints'=>$total_appoints,
                    'booked_appoints'=>$booked_appoints,
                    'done_appoints'=>$done_appoints,
                    'appoint_req' => $appoint_req,
                    'patients'=>$patients,
                    'bills'=>$bills,
                    'count'=>$count,
                    'charges'=>$charges
                    ];
            return view('dashboard.index',[
                'data' =>$doctor,
            ]);
        }
        elseif ($user =='patient'){
            $total = [];
            $patient = ['count'=>$count];
            $total['appoint'] = Appointment::where('patient_id',$user_id)->count()+ User_Appointment::where('patient_id',$user_id)->count();
            $total['bill'] = Bill::where('patient_id',$user_id)->count();
            $total['pre'] = Prescription::whereHas('appoint',function($q) use($user_id){
                $q->where('patient_id',$user_id);} )->count();
            $total['test'] = Lab::whereHas('appoint',function($q) use($user_id){
                $q->where('patient_id',$user_id);} )->count();
            return view('dashboard.index',[
                'data' =>$patient,
                'total' =>$total,
            ]);
        }
        elseif ($user =='employee'){
            $type = User_detail::where('user_id',$user_id)->first();
            if($type['department_id']==18){
                $employee = ['count'=>$count];
                $tbills = Bill::all()->count();
                $fbills = Bill::where('payed',0)->count();
                $rbills = Appointment::where('done',1)->where('bill_id',NULL)->count();
                return view('dashboard.index',[
                    'type' =>'acc',
                    'data' =>$employee,
                    'tbills' =>$tbills,
                    'fbills' =>$fbills,
                    'rbills' =>$rbills,
                ]);
            }
            elseif($type['department_id']==19){
                $value = 1;
                $employee = ['count'=>$count];
                $rooms = Room::where('status',0)->count();
                $in_patients = User::whereHas('user_detail', function($q) use($value) {
                $q->where('is_in', $value);})->count();
                return view('dashboard.index',[
                    'type' =>'rec',
                    'data' =>$employee,
                    'rooms' =>$rooms,
                    'in_patients' =>$in_patients,
                ]);
            }
            else{
                dd('Null');
            }
            $employee = ['count'=>$count];
            return view('dashboard.index',[
                'data' =>$employee,
            ]);
        }
    }
    public function profileSetting($id){
        $id = Auth::user()->id;
        $user = User::find($id);
        $departments = Department::all();
        return view('dashboard.profileSetting',[
            'user'=>$user,
            'departments'=>$departments
        ]);
    }
    public function doctorAppointment(){
        $id = Auth::user()->id;
        $appointments = Appointment::all()-> where('doctor_id',$id)->where('done',0);
        $appoint_req = User_Appointment::where('doctor_id',$id)
                                            ->where('accepted',0)->with('patient')->get()??'';
        return view('dashboard.doctorAppointment',[
            'appointments'=>$appointments,
            'appoint_req'=>$appoint_req,
        ]);
    }
    public function diagnosis($type,$id){
        $tests = ['CBC','Hemoglobin','OH_Vitamin_D-25','Semen_Analysis','Electrocardiogram','Pregnancy_Beta-hCG','Folic_Acid'];
        $appointment = '';
        ($type == 'doc')? $appointment = Appointment::find($id): $appointment = User_Appointment::find($id);
        $patient_id = $appointment['patient_id'];
        $diagnosis = Diagnosi::where('patient_id',$patient_id)->get();
        $results = Lab::where('appoint_id',$id)->first();
        $results ? ($results['results']  ? $testresults= explode (",", $results['results']):$testresults=[]) :$testresults=[];

        return view('dashboard.diagnosis',[
            'appointment'=>$appointment,
            'diagnosis'=>$diagnosis,
            'tests'=>$tests,
            'testresults' =>$testresults,
        ]);
    }
    public function setdiagnosis(Request $request){
        $app_id =$request->input('appoint_id');
        $diag = Diagnosi::create([
            'doctor_id' =>$request->input('doctor_id'),
            'patient_id' =>$request->input('patient_id'),
            'appoint_id' =>$app_id,
            'diagnosing' =>$request->input('diagnosing'),
        ]);
        $appoint = Appointment::find($app_id);
        $appoint['charges_text'] .='Doctor_Charge: '.$request->input('doctor_charge').' $ ';
        $appoint->save();

        return view('dashboard.prescription.create',[
            'appoint'=>$appoint,
        ]);
        // dd('OK!!');
    }
    public function settests(Request $request){
        $tests = '';
        $appoint_id =$request->input('appoint_id');

        foreach($request['tests'] as $key =>$test){
            $key+1 == count($request['tests']) ? $tests .=$test:$tests .=$test.",";
        }
        $test = Lab::create([
            'appoint_id' =>$appoint_id,
            'tests' =>$tests,
        ]);
        return redirect()->back()->with('message','requested tests send to labs');
    }
    public function gettests(){
        $tests = Lab::with('appoint')->where('done',0)->get();
        return view('dashboard.gettests',[
            'tests' =>$tests,
        ]);
    }
    public function donetests($id){
        $tests = Lab::where('appoint_id',$id)->where('done',0)
                ->first();
        $test_arr = explode (",", $tests['tests']);
        return view('dashboard.donetests',[
            'tests' =>$test_arr,
            'id' =>$tests['id'],
        ]);
    }
    public function updateTest(Request $request,$id){
        $tests = Lab::with('appoint')->where('id',$id)->first();
        $name = $tests->appoint->patient->username;
        $test_arr = explode (",", $tests['tests']);
        $result = '';
        $appoint = Appointment::find($tests->appoint_id);
        $appoint['charges_text'] .='Test_charge: '.$request['total_charge'].'$$ ';
        $appoint->save();
        foreach ($test_arr as $key =>$test) {
            $request->validate([
                $test=>'mimes:pdf'
            ]);
            $file =  $request->file($test);
            if($file){
            $testFileName = date("Y_m_d-H:i").'_'.$name.'_'.$test.'.'.'pdf';
            $file->move(public_path('storage/images/tests'),$testFileName);
            $key+1 == count($test_arr) ? $result .=$testFileName :$result .=$testFileName.',';
            }
            else{
                $key+1 == count($test_arr) ? $result .='NULL' :$result .='NULL,';
            }
        }
        $tests['results'] = $result;
        $tests['done'] = 1;
        $tests->save();

        // return redirect()->back();
        return redirect('/dashboard');

    }
    public function bookedappointment(){
        $id = Auth::user()->id;
        $appointments = Appointment::with('patient')
                                    -> where('doctor_id',$id)
                                    -> where('is_token',1)
                                    ->get();
        $userAppointments = User_Appointment::with('patient')
                                    -> where('doctor_id',$id)
                                    -> where('accepted',1)
                                    ->get();
        return view('dashboard.bookedappointment',[
            'appointments'=>$appointments,
            'userAppointments'=>$userAppointments,
        ]);
    }
    public function editProfile(Request $request, $id){
        $user = User::find($id);
        $image = User_detail::where('user_id',$id)->get();

        $request->validate([
            'image'=>'mimes:png,jpg,jpeg|max:5048'
        ]);
        $newImageName = $image[0]['profile_photo_path'] ?? NULL;
        if (!empty($request->file('image'))) {
            $exist = $newImageName;
            $newImageName = time().'_'.$user['username'].'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('storage/images/profile'),$newImageName);
                if (!empty($exist)) {
                    $filepath =public_path('storage/images/profile/'.$exist) ;
                unlink($filepath);
            }
        }

        $user_detail = User_detail::where('user_id',$id)
            ->update([
                'department_id'=>$request->input('department'),
                'full_name'=>$request->input('full_name'),
                'birthday'=>$request->input('birthday'),
                'gender'=>$request->input('gender'),
                'phone'=>$request->input('phone'),
                'address'=>$request->input('address'),
                'profile_photo_path'=>$newImageName
        ]);
        return redirect()->route('profile',['id'=>$id]);
    }
    public function addpatient(){
        $departments =Department::all();
        return view('dashboard.addpatient',['departments'=>$departments]);
    }
    public function savepatient(){
        $data = request();
        $newImageName = NULL;
        if (!empty($data['image'])) {
            $newImageName = time().'_'.$data['username'].'.'.$data['image']->extension();
            $data['image']->move(public_path('storage/images/profile'),$newImageName);
        }

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'type' => 'patient',
            'password' => Hash::make($data['password']),
        ]);
        $user_details = User_detail::create([
            'user_id' => $user->id,
            'full_name' => $data['fullname'],
            // 'department_id' => $data['department'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'profile_photo_path' => $newImageName,
        ]);
        return redirect()->back()->with('msg','User Added');

    }
    public function book4patient(){
        $departments = Department::Limit(13)->get();
        $patients = User::where('type','patient')->get();
        return view('dashboard.book4patient',[
            'departments'=>$departments,
            'patients'=>$patients,
        ]);
    }
    public function emergency(){
        $departments = Department::Limit(13)->get();
        $patients = User::where('type','patient')->get();
        $username = 'Emerg-'.substr((time()+ rand(1,1000)),-5);
        return view('dashboard.emergency',[
            'departments'=>$departments,
            'patients'=>$patients,
            'username' => $username,
        ]);
    }
    public function cancleAppoint(Request $request){
        $appoint = Appointment::find($request['appoint_id']);
        $id = Auth::user()->id;
        $message = Message::create([
            'from_u_id' =>$id,
            'to_u_id'=>$appoint['patient_id'],
            'subject'=>'Cancle An appointment',
            'body'=>'Sorry about cancle your Appointment with Date: '.$appoint['appoint_date'].'and Time '.$appoint['appoint_time'].' And I sujest you to '. $request['message']
        ]);
        $appoint->delete();
        return redirect()->route('doctorAppointment');
    }
    public function limits(){
        $limits = Medicine::whereColumn('start_quantity','<=','limit_quant')->get();
        return view('dashboard.limit',[
            'limits'=>$limits,
        ]);
    }
}
