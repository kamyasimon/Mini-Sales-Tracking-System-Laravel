<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use App\Roles;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookings;

class BookingsController extends Controller
{
    //
    public function bookings(){
        $bookings = Bookings::all();
        if(Auth::user()->fkrole == 2){
            return view('admin.bookings.bookings',compact('bookings'));
        }else{
            return redirect('sales')->with('warning',Auth::user()->name.' You are not Eligible to see this');
        }
        
    }

    public function addbooking(Request $request){
        $book = Bookings::create([
            'customername'=>$request->input('customername'),
            'customernumber'=>$request->input('customernumber'),
            'productdescription'=>$request->input('productdescription'),
            'fkuser'=>Auth::user()->id,
        ]);

        return back()->with('success','Item Booked Successfully');
    }

}
