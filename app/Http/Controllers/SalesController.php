<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investiments;
use App\Models\Sales;
use App\Models\Stocks;
use App\Models\User;
//use App\Roles;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function sales(){
        $sales= Sales::all();

        return view('admin.sales.sales',compact('sales'));
    }

    public function addsale(Request $request){

        $quantitysold= $request->input('quantitysold');

        $saleprice =$request->input('saleprice');
        $amountsold =$saleprice * $quantitysold;

        $expenditureamount = $request->input('expenditureamount');

        $totalprice = $amountsold - $expenditureamount;

        $createsale = Sales::create([
            'itemsold'=>$request->input('itemsold'),
            'quantitysold'=>$quantitysold,
            'amountsold'=>$amountsold,
            'expenditure'=>$request->input('expenditure'),
            'expenditureamount'=>$expenditureamount,
            'totalprice'=>$totalprice,
            'customername'=>$request->input('customername'),
            'customernumber'=>$request->input('customernumber'),
            'company'=>$request->input('company'),
            'fkuser'=>Auth::User()->id,
        ]);

        


        return back()->with('Success','Item Sold Successfully');
    }

    public function delivered($id){
        $delivered =Sales::find($id)->update([
            'orderstatus'=>'delivered',
        ]);

        return back()->with('success','Item/Order Delivered');
    }

    public function paid($id){
        ///Check Investiments
         $current = Investiments::where('id',Auth::user()->id)->get();
            $currentsales = $current[0]->sales;
            $currentprofits = $current[0]->profits;
            $currentworkingcapital = $current[0]->workingcapital;

            ///Check Sales
            $sales = Sales::find($id);
           // $quantity = $sales->quantitysold;
            $totalprice = $sales->totalprice;

            $totalsales =$currentsales + $totalprice;
            $totalprofits =  $totalsales - $currentworkingcapital;

            $updateinvestiment = Investiments::where('id',1)->update([
                'sales'=>$totalsales,
                'profits'=>$totalprofits
            ]);

            if($updateinvestiment){
                $paid =Sales::find($id)->update([
                       'orderstatus'=>'paid',
                    ]);
                    return back()->with('success','Item/Order Fully Paid');
            }else{
                return back()->with('danger','Item/Order NOT  Fully Paid');
            }
      

        
    }
}
