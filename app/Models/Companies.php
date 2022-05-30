<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = "companies";
    protected $fillable = [
        'companyname',
        'fkadmin'
		
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','fkadmin');
    }

    public function Investiments()
    {
        return $this->hasOne('App\Models\Investiments','id');
    }
    public function Stocks(){
        return $this->hasMany('App\Models\Stocks','id');
     }

     public function Sales(){
        return $this->hasMany('App\Models\Sales','id');
      }

      public function Expenses(){
        return $this->hasMany('App\Models\Expenses','id');
      }
}
