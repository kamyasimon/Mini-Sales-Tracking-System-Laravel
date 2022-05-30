<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
    protected $table = "batches";
    protected $fillable = [
        'batch',
        'visible',
		
    ];

    public function Stocks(){
        return $this->hasMany('App\Models\Stocks','id');
     }
}
