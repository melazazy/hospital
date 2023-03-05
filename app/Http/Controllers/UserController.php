<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Active user
    public function update(Request $request){
        $id = Auth()->user()->id;
        $admin = User::where([['id','=',$id],['type','=','admin'],['active','=',1],['email_verified_at' ,'!=' ,NULL]])->get();
        $msg='';
        if(sizeof($admin) != 0){
            $active = User::find($request['id']);
            if($active != NULL and $active['email_verified_at'] != NULL){
                $active['active']=1;
                $active->save();
                $msg=$active['username'].' Active';
            }
            else
                $msg = 'Can Not Active not Verified User';
        }
        else
            $msg = 'You don\'t have Permessions';

        return redirect()->back()->with('msg',$msg);
    }
    public function deleteUser($id){
        $admin_id = Auth()->user()->id;
        $admin = User::where([['id','=',$admin_id],['type','=','admin'],['active','=',1],['email_verified_at' ,'!=' ,NULL]])->get();
        $msg='';
        if(sizeof($admin) != 0){
            $delete = User::find($id);
            if($delete != NULL){
                $delete->delete();
                $msg=$delete['username'].' Is Deleted';
            }
            else
                $msg = 'Can Not Delete This User';
        }
        else
            $msg = 'You don\'t have Permessions';

        return redirect()->back()->with('msg',$msg);
    }
}
