<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Investiments;
use App\Models\Companies;
//use App\Roles;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    //
    public function expenses(){

        $expenses=Expenses::orderBy('created_at','DESC')->get();
        $companies=Companies::orderBy('companyname','DESC')->get();
        return view('admin.expenses.expenses',compact('expenses','companies'));
    }

    public function addexpense(Request $request){
        $fkcompany = Investiments::find($request->input('company'));
       // dd($fkcompany);
        $expense = Expenses::create([
            'fkcompany'=>$request->input('company'),
            'purpose'=>$request->input('purpose'),
            'amount'=>$request->input('amount'),
            'fkuser'=>Auth::user()->id,
        ]);
        if($expense !== null){
            $oldcapital = $fkcompany -> workingcapital;
           // dd($oldcapital);
            $reducecapital =Investiments::where('fkcompany',$request->input('company'))->update([
                
                'workingcapital'=>$oldcapital + $request->input('amount'),
            ]);

            return back()->with('success','Expense Recorded And Capital Reduced');
        }else{
            return back()->with('danger','No values modified');
        }
    }
}
