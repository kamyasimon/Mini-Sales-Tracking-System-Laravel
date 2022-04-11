<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Sales extends Model
{
    protected $table = "sales";
    protected $fillable = [
        'company',
        'itemsold',
        'quantitysold',
        'amountsold',
        'customername',
        'customernumber',
        'expenditure',
        'expenditureamount',
        'totalprice',
        'orderstatus',
        'fkuser'
		
    ];

  //  public function User(){
//
  //      return $this->hasMany('App\Models\User','fkuser');
 //   }
}
