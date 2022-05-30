<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
class ProductsController extends Controller
{
    //
    public function products(){
        $products = Products::orderBy('productname','ASC')->get();
        return view('admin.products.products',compact('products'));
    }

    public function addproduct(Request $request){
        $addproduct = Products::create([
            'productname'=>$request->input('productname')
        ]);
        return back()->with('success', 'Product Created');
    }
}
