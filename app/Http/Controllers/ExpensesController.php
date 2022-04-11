<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Investiments;
//use App\Roles;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    //
    public function expenses(){

        $expenses=Expenses::all();
        return view('admin.expenses.expenses',compact('expenses'));
    }

    public function addexpense(Request $request){
        $expense = Expenses::create([
            'company'=>$request->input('company'),
            'purpose'=>$request->input('purpose'),
            'amount'=>$request->input('amount'),
            'fkuser'=>Auth::user()->id,
        ]);
        if($expense !== null){
            $oldcapital =Investiments::find(Auth::user()->id)->capital;
           // dd($oldcapital);
            $reducecapital =Investiments::find(Auth::user()->id)->update([

                'capital'=>$oldcapital - $request->input('amount'),
            ]);

            return back()->with('success','Expense Recorded And Capital Reduced');
        }else{
            return back()->with('danger','No values modified');
        }
    }
}
