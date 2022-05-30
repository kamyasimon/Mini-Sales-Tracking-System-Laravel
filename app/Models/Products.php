<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    protected $fillable = [
        'productname',
        'visible'
		
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','fkadmin');
    }

    public function Stocks(){
        return $this->hasMany('App\Models\Stocks','id');
     }

     public function Sales(){
        return $this->hasMany('App\Models\Sales','id');
      }

}
