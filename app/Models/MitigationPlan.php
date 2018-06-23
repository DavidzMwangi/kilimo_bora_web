<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitigationPlan extends Model
{
    //
    public function Crop(){
        return $this->hasOne(Crop::class,'id','crop_id');
    }
}
