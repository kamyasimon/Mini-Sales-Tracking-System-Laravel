<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks;
use App\Models\Investiments;
use App\Models\User;
//use App\Roles;
use Illuminate\Support\Facades\Auth;
class StocksController extends Controller
{
    public function stock(){
        $stocks=Stocks::all();

        return view('admin.stock.stocks',compact('stocks'));
    }

    public function addstock(Request $request){
        $stockquantity=$request->input('quantity');
        $stockprice=$request->input('stockprice');
        $salesprice=$request->input('saleprice');

        ////////////STOCK AMOUNT
        $stockamount= $stockquantity * $stockprice;

        $projectedsales =($salesprice * $stockquantity)-$stockamount;

        $createstock = Stocks::create([
            'itemstocked'=>$request->input('stockitem'),
            'stockquantity'=>$stockquantity,
            'stockamount'=>$stockamount,
            'stockprice'=>$stockprice,
            'saleprice'=>$salesprice,
            'projectedsales'=>$projectedsales,
            'fkuser'=>Auth::user()->id,

        ]);

        if($createstock !== null){

            $currentcapitalx = Investiments::where('fkuser',1)->get();
           // dd($currentcapitalx);
            $currentcapital=$currentcapitalx[0]->capital;
            $currentworkingcapital=$currentcapitalx[0]->workingcapital;            
            $newcapital =$currentcapital- $stockamount;

            $updatecapital = Investiments::where('fkuser',1)->update([
                'capital'=>$newcapital,
                'workingcapital'=>$currentworkingcapital + $stockamount,
            ]);

        }

        return back()->with('success','Stock Added');

    }

}
