<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investiments extends Model
{
    protected $table = "investiments";
    protected $fillable = [
        'workingcapital',
        'withdraws',
        'sales',
        'profits',
        'fkuser',
        'fkcompany',
        'fkadmin'
		
    ];
    public function User()
    {
        return $this->belongsTo('App\Models\User','fkadmin');
    }

    public function Companies()
    {
        return $this->belongsTo('App\Models\Companies','fkcompany');
    }
    
}
