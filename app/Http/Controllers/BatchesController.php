<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batches;
class BatchesController extends Controller
{
    //
    public function addstockbatch(Request $request){
            if(Batches::where('batch',$request->input('batch'))->exists()){
                return back()->with('danger','Batch already exists');
            }else{
        $addbatch = Batches::create([
            'batch'=>$request->input('batch'),
        ]);
        return back()->with('success','Stock Batch Created');
    }
    }
}
