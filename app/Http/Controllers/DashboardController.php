<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investiments;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\User;
//use App\Roles;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    //
    public function dashboard(){
        $investiments = Investiments::all();
           // dd($investiments);
           if(Auth::User()->fkrole == 2 ){
            return view('admin.dashboard',compact('investiments'))->with('success','You are now logged in as '. Auth::user()->name);
           }elseif (Auth::User()->fkrole == 3 ) {
              return redirect('sales')->with('success','You are now logged in as '. Auth::user()->name);
           }
           else{
            Session::flush();
            Auth::logout();
            return redirect('login');
           }
        
    }
    
    
    public function initiate(){

            $initiate=Investiments::create([
                'fkuser'=>Auth::user()->id,
            ]);
        return back()->with('success','Investiment Initiated');
    }

    /////////////////ADD CAPITAL
    public function addcapital(Request $request){
        $currentcapitalx = Investiments::where('fkuser',1)->get();
        // dd($currentcapitalx);
         $currentcapital=$currentcapitalx[0]->capital;

        $updatecapital = Investiments::where('fkuser',1)->update([
            'capital'=> $currentcapital + $request->input('capital'),
        ]);

        return back()->with('success','Capital Updated Successfully');
    }
}
