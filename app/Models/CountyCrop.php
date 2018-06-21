<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountyCrop extends Model
{
    //
    public function subCounty()
    {
        return $this->hasOne(SubCounty::class,'id','sub_county_id');
    }

    public function Crop()
    {
        return $this->hasOne(Crop::class,'id','crop_id');
    }
}
