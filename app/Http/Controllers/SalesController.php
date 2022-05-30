<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investiments;
use App\Models\Sales;
use App\Models\Stocks;
use App\Models\User;
use App\Models\Companies;
use App\Models\Products;
use App\Models\Batches;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
        
    public function sales(){
        $sales= Sales::orderBy('created_at','DESC')->get();
        $companies = Companies::orderBy('companyname','ASC')->get();
        $products = Products::orderBy('productname','ASC')->get();
        $batches = Batches::orderBy('created_at','DESC')->get();
        $stocks = Stocks::orderBy('created_at','DESC')->get();
            
        return view('admin.sales.sales',compact('sales','companies','products','batches','stocks'));
    }

    public function addsale(Request $request){
        //dd('Check the stock amount before making a sale');
        $x = $request->input('stockid');
        $p = $request->input('product');
        $c = $request->input('company');
       
        $checkavailablequantity = Stocks::where('stockid',$x)->get();
        $checkpdt = Products::where('id',$p)->get();
        $chechcompany = Companies::where('id',$c)->get();
      //  dd($chechcompany[0]->id);
      //  dd($checkavailablequantity[0]->availablestock);
        if($request->input('quantitysold') > $checkavailablequantity[0]->availablestock){
        return back()->with('danger','Sale NOT Recorded, Input quantity is greater than available stock');
         } //  dd('Check if product selected and product in batch id are the same');
         elseif ($checkavailablequantity[0]->itemstocked !== $checkpdt[0]->id) {
           //  dd('product not the same');
            return back()->with('danger','NOT Recorded, Product selected doesnt correspond with Stock ID');
         }//  dd('Check if product company in batch is the same');

     elseif($request->input('company') == !null || $request->input('product') == !null || $request->input('batch') == !null){
    //dd('they are the same'); 
    $quantitysold= $request->input('quantitysold');

        $saleprice =$request->input('saleprice');
        $amountsold =$saleprice * $quantitysold;

        $expenditureamount = $request->input('expenditureamount');

        $totalprice = $amountsold - $expenditureamount;

        $createsale = Sales::create([
            'itemsold'=>$request->input('product'),
            'batch'=>$request->input('batch'),
            'stockid'=>$request->input('stockid'),
            'quantitysold'=>$quantitysold,
            'amountsold'=>$amountsold,
            'expenditure'=>$request->input('expenditure'),
            'expenditureamount'=>$expenditureamount,
            'totalprice'=>$totalprice,
            'customername'=>$request->input('customername'),
            'customernumber'=>$request->input('customernumber'),
            'fkcompany'=>$request->input('company'),
            'fkuser'=>Auth::User()->id,
        ]);

        


        return back()->with('Success','Item Sold Successfully');
        }
        else{
            return back()->with('danger','All fields are required on product sell');
        }
        
    }

    public function delivered($id){
        $sale = Sales::find($id);
        $stock = Stocks::where('stockid',$sale->stockid)->get();
       $newavailable = $stock[0]->availablestock - $sale->quantitysold;
      // dd($stock[0]);

        
      //  dd( $sale->stockid);
     
      if($newavailable < 0){
       // dd($newavailable);
        return back()->with('warning','NOT RECORDED, Item/Order Input is higher than available');
      }else{
      //  dd($sale->quantitysold);
      $updatestock = Stocks::where('stockid', $sale->stockid)->update([
        'availablestock'=> $newavailable
    ]);
 //   dd($updatestock);
        $delivered =Sales::find($id)->update([
            'orderstatus'=>'delivered',
        ]);
      //  dd( $sale->quantitysold);
       

        return back()->with('success','Item/Order Delivered');
      }
       
    }

    public function paid($id){
         ///Check Sales
         $sales = Sales::find($id);
        ///Check Investiments
         $current = Investiments::where('fkcompany',$sales->fkcompany)->get();
            $currentsales = $current[0]->sales;
            $currentprofits = $current[0]->profits;
            $currentworkingcapital = $current[0]->workingcapital;

           
           // $quantity = $sales->quantitysold;
            $totalprice = $sales->totalprice;

            $totalsales =$currentsales + $totalprice;
            $totalprofits =  $totalsales - $currentworkingcapital;

            $updateinvestiment = Investiments::where('fkcompany',$sales->fkcompany)->update([
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

    public function handedover($id){
        $handedover =Sales::find($id)->update([
            'handedover'=>true,
         ]);
        return back()->with('success','Money Handed Over');
    }
}
