<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = "stocks";
    protected $fillable = [
       'stockid',
        'batch',
        'stockkey',
        'itemstocked',
        'stockquantity',
        'stockamount',
        'stockprice',
        'saleprice',
        'projectedprofits',
        'fkcompany',
        'availablestock'
		
    ];

    public function Companies(){
              return $this->belongsTo('App\Models\Companies','fkcompany');
           }
      public function Products(){
            return $this->belongsTo('App\Models\Products','itemstocked');
         }
         public function Batches(){
            return $this->belongsTo('App\Models\Batches','batch');
         }
}

