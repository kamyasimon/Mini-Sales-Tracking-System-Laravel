<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = "stocks";
    protected $fillable = [
        'itemstocked',
        'stockquantity',
        'stockamount',
        'stockprice',
        'saleprice',
        'projectedsales',
        'fkuser'
		
    ];
}

