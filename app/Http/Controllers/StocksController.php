<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks;
use App\Models\Investiments;
use App\Models\User;
use App\Models\Companies;
use App\Models\Products;
use App\Models\Batches;

//use App\Roles;
use Illuminate\Support\Facades\Auth;

class StocksController extends Controller
{
   

    public function stock(){
        $stocks=Stocks::orderBy('created_at','DESC')->get();
        $companies = Companies::orderBy('companyname','ASC')->get();
        $products = Products::orderBy('productname','ASC')->get();
        $batches = Batches::where('visible',true)->orderBy('created_at','DESC')->get();
        return view('admin.stock.stocks',compact('stocks','companies','products','batches'));
    }

    public function addstock(Request $request){
        $lf=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $xf=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
         $x=rand(0,25);
         $y=rand(25,0);

         $stockid=$lf[$x].time().$xf[$y];

        $stockquantity=$request->input('quantity');
        $stockprice=$request->input('stockprice');
        $salesprice=$request->input('saleprice');

        ////////////STOCK AMOUNT
        $stockamount= $stockquantity * $stockprice;

        $projectedprofits =($salesprice * $stockquantity)-$stockamount;
          //  dd($projectedprofits);
        $batchexists = Stocks::where('batch',$request->input('batch'))->get();
       // dd($batchexists);
        if( $request->input('batch') == null || $request->input('fkcompany') == null || $request->input('product') == null ){
            return back()->with('danger','All fields are required');
        }else{
            $createstock = Stocks::create([
                'fkcompany'=>$request->input('fkcompany'),
                'stockid'=>$stockid,
                'batch'=>$request->input('batch'),
                'itemstocked'=>$request->input('product'),
                'stockquantity'=>$stockquantity,
                'stockamount'=>$stockamount,
                'stockprice'=>$stockprice,
                'saleprice'=>$salesprice,
                'projectedprofits'=>$projectedprofits,
                'availablestock'=>$stockquantity,
                
            ]);
    
            if($createstock !== null){
                    //dd($request->input('fkcompany'));
                $currentcapitalx = Investiments::where('fkcompany',$request->input('fkcompany'))->get();
               // dd($currentcapitalx);
             //   $currentcapital=$currentcapitalx[0]->capital;
                $currentworkingcapital=$currentcapitalx[0]->workingcapital;            
              ///  $newcapital =$currentcapital- $stockamount;
    
                $updatecapital = Investiments::where('fkcompany',$request->input('fkcompany'))->update([
                   
                    'workingcapital'=>$currentworkingcapital + $stockamount,
                ]);
    
            }
    
            return back()->with('success','Stock Added');
        }
       

    }

}
