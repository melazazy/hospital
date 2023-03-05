<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_Appointment;
use App\Models\User_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;
use App\Models\Medicine;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }
    public function profile($id){
        $user = User::find($id);

        return view('profile',[
            'user' =>$user,
        ]);
    }
    public function readpdf($file){
        $path = public_path('/storage/images/tests/' . $file);
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $file . '"'
        ];
        return response()->file($path, $header);
    }
    public function userappointment(){
        $departments = Department::Limit(13)->get();
        $user = NULL;
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
        }

        return view('userappointment',[
            'departments'=>$departments,
            'user' => $user,
        ]);
    }
    public function getDoctor($departmentid = 1){
        $doctors = User_detail::where('department_id',$departmentid)->get();
        return response()->json($doctors);
    }
    public function getroom($departmentid = 1){
        $rooms = Room::where('department_id',$departmentid )->where('status',0)->get();
        return response()->json($rooms);
    }
    public function getAppoints($departmentid = 1){
        $doctors = Appointment::where('department_id',$departmentid)->where('is_token',0)->with('doctor',function($q){
            $q->with('user_detail');
        })->get();
        return response()->json($doctors);
    }
    public function getMedicine($text = 'a'){
        $medicine = Medicine::where('name','LIKE','%'.$text.'%')->limit(10)->orderBy('name', 'asc')->get();
        return response()->json($medicine);
    }
    public function getMedicineid($id){
        $medicine = Medicine::find($id);
        return response()->json($medicine);
    }
    public function getUser($text = 'a'){
        $user = User::where('username','LIKE','%'.$text.'%')->limit(10)->orderBy('username', 'asc')->get();
        return response()->json($user);
    }

    public function getMailCount( $id =1){
        $count = Message::where('to_u_id',$id)->where('isRead',0)->count();
        return $count;
    }

    public function storeUserAppoint(Request $request){
        // TODO
        // Register patient if Not logged in =>  Auth::user()== NULL
        // Send Message to user to change his password
        // Else make user appointment
        $note =request('full_name'). ' ,'.request('email') .' ,'.request('phone').','.request('gender').','.request('birthday') ;
        $user_id = 35;
        if(Auth::user()){
            $user_id = Auth::user()->id;
            User_Appointment::create([
                'patient_id' =>$user_id,
                'department_id' =>$request->input('department'),
                'doctor_id' =>$request->input('doctor'),
                'appoint-date' =>$request->input('appoint-date'),
                'appoint-time' =>$request->input('appoint-time'),
                'notes' =>$note,
            ]);
            return redirect('dashboard')->with('msg','Appointment Make Succesfly');
        }else{
            $data = $request;
            $newImageName = NULL;
            $name = explode(" ",$data['full_name']);
            $username= $name[0].'_'.substr((time()+ rand(1,1000)),-5);
            $password = 'appoint_pass';
            $user = User::create([
                'username' => $username,
                'email' => $data['email'],
                'type' => 'patient',
                'password' => Hash::make($password),
            ]);
            $user_details = User_detail::create([
                'user_id' => $user->id,
                'full_name' => $data['fullname'],
                'birthday' => $data['birthday'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'profile_photo_path' => $newImageName,
            ]);
            $user_id = $user->id;
            $link ='&lt;a class=&quot;btn btn-link&quot; href=&quot;http://localhost:8000/password/reset&quot;&gt;Reset Your Password&lt;/a&gt;';
            $body = 'Welcome '.$data['full_name'].' to our Hospital .....\n Your Login Details : E-mail : '.$data['email'].' and Password : '.$password.' Please Reset Your Password throue This Link \n:'.html_entity_decode($link);
            User_Appointment::create([
                'patient_id' =>$user_id,
                'department_id' =>$request->input('department'),
                'doctor_id' =>$request->input('doctor'),
                'appoint-date' =>$request->input('appoint-date'),
                'appoint-time' =>$request->input('appoint-time'),
                'notes' =>$note,
            ]);
            Message::create([
                'from_u_id'=>1,
                'to_u_id'=>$user_id,
                'subject'=>'Please Reset Password For Your New Account',
                'body'=>$body,
            ]);
            Auth::login($user);
            return redirect('dashboard')->with('msg','Please View Your message Inbox');
        }
        return redirect('/');
    }
    public function updateUserAppoint($id){
        $app = User_Appointment::find($id);
        if($_POST){
            if ($_POST['update']==1) {
                $appoint = Appointment::create([
                    'patient_id' =>$app['patient_id'],
                    'doctor_id' =>$app['doctor_id'],
                    'department_id' =>$app['department_id'],
                    'appoint_date' =>$app['appoint-date'],
                    'appoint_time' =>$app['appoint-time'],
                    'is_token' =>1,
                    'created_at' =>$app['created_at'],
                    'updated_at' =>$app['updated_at'],
                ]);
                $app->delete();
                return redirect('dashboard')->with('msg','User Appoint Accepted And move to Recived Appoint');
            }
            else{
                $app->delete();
                return redirect('dashboard')->with('msg','User Appoint Deleted');
            }
        }
        return redirect('dashboard');
    }
    public function cancelAppoint($id){
        $user_id = Auth::user()->id;
        $app = Appointment::find($id);
        if($app['patient_id'] == $user_id){
            $app['patient_id'] = NULL;
            $app['is_token'] = 0;
            $app->save();
            return redirect('dashboard')->with('msg','Your Appoint Canceled');
        }
        else{
            return redirect('dashboard')->with('msg','You do not have permission to delete this appointment');
        }
        return redirect('dashboard');
    }
    public function deleteOwnAppoint($id){
        $user_id = Auth::user()->id;
        $app = User_Appointment::find($id);
        if($app['patient_id'] == $user_id){
            $app->delete();
            return redirect('dashboard')->with('msg','Your Appoint Deleted');
        }
        else{
            return redirect('dashboard')->with('msg','You do not have permission to delete this appointment');
        }
        return redirect('dashboard');
    }

    public function emergencyAppoint(Request $request){
        $data = $request;
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
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'profile_photo_path' => $newImageName,
        ]);
        $appointment = Appointment::find($data['doctor']);
        $appointment['patient_id']=$user->id;
        $appointment['is_token']=1;
        $appointment->save();
        return redirect()->route('dashboard');
    }

    public function bookRoom(){
        $departments = Department::Limit(13)->get();
        $patients = User::where('type','patient')->get();
        return view('dashboard.bookroom',[
            'departments'=>$departments,
            'patients'=>$patients,
        ]);
    }
    public function updateRoom(Request $request){
        $id = $request->input('room_id');
        $patient_id = $request->input('patient_id');
        $room = Room::find($id);
        $room['status'] = 1;
        $room['patient_id'] =$patient_id ;
        $room->save();
        $user = User_detail::where('user_id',$patient_id)->first();
        $user['is_in']=1;
        $user->save();
        $departments = Department::Limit(13)->get();
        $patients = User::where('type','patient')->get();
        return view('dashboard.bookroom',[
            'departments'=>$departments,
            'patients'=>$patients,
        ]);
    }
    // for Review Only Not Used
    public function contactUs(){
        if (isset($_POST['email'])) {
            $email_to = "mazaz52@gmail.com";
            $email_subject = "New Hospital form submissions";
            function problem($error)
            {
                echo "We are very sorry, but there were error(s) found with the form you submitted. ";
                echo "These errors appear below.<br><br>";
                echo $error . "<br><br>";
                echo "Please go back and fix these errors.<br><br>";
                die();
            }
            if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
                problem('We are sorry, but there appears to be a problem with the form you submitted.');
            }
            $name = $_POST['name']; // required
            $email = $_POST['email']; // required
            $message = $_POST['message']; // required
            $message = $_POST['phone']; // required

            $error_message = "";
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

            if (!preg_match($email_exp, $email)) {
                $error_message .= 'The Email address you entered does not appear to be valid.<br>';
            }
            $string_exp = "/^[A-Za-z .'-]+$/";

            if (!preg_match($string_exp, $name)) {
                $error_message .= 'The Name you entered does not appear to be valid.<br>';
            }

            if (strlen($message) < 2) {
                $error_message .= 'The Message you entered do not appear to be valid.<br>';
            }

            if (strlen($error_message) > 0) {
                problem($error_message);
            }

            $email_message = "Form details below.\n\n";

            function clean_string($string)
            {
                $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                return str_replace($bad, "", $string);
            }

            $email_message .= "Name: " . clean_string($name) . "\n";
            $email_message .= "Email: " . clean_string($email) . "\n";
            $email_message .= "Message: " . clean_string($message) . "\n";
            $headers = 'From: ' . $email . "\r\n" .
                'Reply-To: ' . $email . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($email_to, $email_subject, $email_message);
        }
        return back()->with('success','Thanks for Contact Us');
    }

    public function sendMail(Request $request){

        $data = [
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
        ];
        Mail::to('mazaz52@gmail.com')->send(new sendMail($data));
        return back()->with('success','Thanks for Sending E-Mail');

    }
}
