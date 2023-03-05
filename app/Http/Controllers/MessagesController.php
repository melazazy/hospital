<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $user_id = Auth()->user()->id;
        $inbox = Message::where('to_u_id',$user_id)->paginate(10);
        return view('messages.index',[
            'inbox'=>$inbox,
        ]);
    }
    public function sent()
    {
        $user_id = Auth()->user()->id;
        $sent = Message::where('from_u_id',$user_id)->paginate(10);
        return view('messages.sent',[
            'sent' =>$sent,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email',$request['user'])->first();
        $message ='';
        if($user){
            $message = Message::create([
                'from_u_id'=>Auth()->user()->id,
                'to_u_id'=>$user['id'],
                'subject'=>$request->input('subject'),
                'body'=>$request->input('message'),
            ]);
        }
        if($message)
            return redirect()->back()->with('msg','Message Already Send');
        else
            return redirect()->back()->with('msg','Sorry Message Not Send');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $message['isRead'] =1;
        $message->save();
        return view('messages.view',[
            'message'=>$message,
        ]);
    }
    public function starred($id)
    {
        $message = Message::find($id);
        $message['isStarred'] == 0 ? $message['isStarred'] = 1:$message['isStarred'] = 0;
        $message->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message=Message::find($id);
        return view('messages.edit',[
            'message'=>$message
        ]);
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
        $user_id = Auth::user()->id;
        $msg ='';
        $message = Message::find($id);
        if ($message['from_u_id']==$user_id) {
            $message['from_u_id']=NULL;
            $msg='Message Deleted Succesfuly';
        } elseif($message['to_u_id']==$user_id) {
            $message['to_u_id']=NULL;
            $msg='Message Deleted Succesfuly';
        }else{
            $msg='You do Not Have Permession To Delete This Message ';
        }
        $message->save();
        return redirect()->back()->with('msg',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect('/messages')->with('del', 'Message Deleted');
    }
}
