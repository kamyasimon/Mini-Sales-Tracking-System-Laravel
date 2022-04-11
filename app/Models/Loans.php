<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $table = "loans";
    protected $fillable = [
        'customername',
        'customernumber',
        'amountloaned',
        'amountpaid',
        'amountbalance',
        'loanstatus',
        'fkuser'
		
    ];
}
