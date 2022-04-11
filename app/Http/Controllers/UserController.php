<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use App\Roles;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function users(){
                $users= User::all();
                if(Auth::user()->fkrole == 2){
                return view('admin.users.users',compact('users'));
            }else{
                return redirect('login')->with('warning',Auth::user()->name.' You are not Eligible to see this');
                
            }
    }

    public function addrole(Request $request,$id){
        $addrole = User::find($id)->update([
            'fkrole'=>$request->input('addrole'),
        ]);

        return back()->with('Success',' User role updated');
    }
}
