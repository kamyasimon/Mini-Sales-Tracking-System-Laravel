<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Loans;
//use App\Roles;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    //
    public function loans(){
        $loans = Loans::all();

        if(Auth::user()->fkrole == 2){
        return view('admin.loans.loans',compact('loans'));
        }else{
            return redirect('sales')->with('warning',Auth::user()->name.' You are not Eligible to see this');
        }
    }

    public function addloan(Request $request){
            


            $loans = Loans::create([
                'customername'=>$request->input('customername'),
                'customernumber'=>$request->input('customernumber'),
                'amountloaned'=>$request->input('amountloaned'),
                'amountbalance'=>$request->input('amountloaned'),
                'fkuser'=>Auth::User()->id,
            ]);
        return back()->with('success','Loan Items Recorded');
    }

    public function payloan(Request $request,$id){
                    $oldpay=Loans::find($id);
                    $balance= $oldpay->amountbalance;
                    
                    $amountpaid = $request->input('payloan');
                    $newbalance = $balance - $amountpaid;
                if($amountpaid > $balance){
                    return back()->with('warning','Payment not updated. Amount submitted is more than required');
            }elseif ($amountpaid < $balance) {
                
                $pay = Loans::find($id)->update([
                    'amountpaid'=>$amountpaid + $oldpay->amountpaid,
                    'amountbalance'=>$newbalance,
                    'loanstatus'=>'pending'
                ]);
                    
                return back()->with('success','Loan Items Recorded');
            }elseif($amountpaid == $balance){
                $pay = Loans::find($id)->update([
                    'amountpaid'=>$amountpaid,
                    'amountbalance'=>$newbalance,
                    'loanstatus'=>'completed'
                ]);
                    
                return back()->with('success','Loan Fully Paid');
            }
            else{
                return back()->with('danger','Loan Records not updated');
            }
            
        
        
    }
}
