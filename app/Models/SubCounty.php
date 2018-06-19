<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    //
    public function County()
    {
        return $this->hasOne(County::class,'id','county_id');
    }
}
