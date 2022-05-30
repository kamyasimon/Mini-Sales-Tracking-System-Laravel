<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = "expenses";
    protected $fillable = [
        'company',
        'purpose',
        'amount',
        'fkuser',
        'fkcompany'
		
    ];

    public function Sales(){
        return $this->hasMany('App\Models\Sales','id');
      }

      public function Companies(){
        return $this->belongsTo('App\Models\Companies','fkcompany');
      }
}
