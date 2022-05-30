<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Sales extends Model
{
    protected $table = "sales";
    protected $fillable = [
        'itemsold',
        'batch',
        'stockid',
        'quantitysold',
        'amountsold',
        'customername',
        'customernumber',
        'expenditure',
        'expenditureamount',
        'totalprice',
        'orderstatus',
        'fkuser',
        'fkcompany',
        'handedover'
		
    ];

  //  public function User(){
//
  //      return $this->hasMany('App\Models\User','fkuser');
 //   }
 public function Companies(){
  return $this->belongsTo('App\Models\Companies','fkcompany');
}

public function Products(){
  return $this->belongsTo('App\Models\Products','itemsold');
}
 

}
