<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\User;
use App\Models\Investiments;
use Illuminate\Support\Facades\Auth;
class CompaniesController extends Controller
{
    //
    
    public function companies(){
        if( Auth::user()->fkrole == 2){
            $companies = Companies::orderBy('companyname','ASC')->get();
        $users = User::orderBy('name','ASC')->get();
        return view('admin.companies.companies',compact('companies','users'));
        }
        else{

            return back();
        }
    }

    public function addcompany(Request $request){
        if(Auth::user()->fkrole == 2){
            if($request->input('fkadmin') !== null){
                $addcompany = companies::create([
                    'companyname'=>$request->input('companyname'),
                    'fkadmin'=>$request->input('fkadmin')
                ]);

            /////find created company
            $newcompany = $addcompany->id;
            // dd($newcomp);
                $initiate=Investiments::create([
                    'fkcompany'=>$newcompany,
                    'fkadmin'=>$request->input('fkadmin')
                ]);
                return back()->with('success', 'company created');
            }else{
                return back()->with('danger', 'NOT CREATED!. Company Admin not assigned');
            }
        }else{
            return back();
        }
                   

    
    }
}
