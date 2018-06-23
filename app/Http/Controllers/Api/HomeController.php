<?php

namespace App\Http\Controllers\Api;

use App\Models\County;
use App\Models\CountyCrop;
use App\Models\Crop;
use App\Models\Disease;
use App\Models\MitigationPlan;
use App\Models\SubCounty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function homeData()
    {
        $counties=County::all();
        $sub_counties=SubCounty::all();
        return response()->json([
            'counties'=>$counties,
            'sub_counties'=>$sub_counties
        ]);

        }

    public function allCrops()
    {
        $crops=Crop::all();
        $county_crops=CountyCrop::all();
        return response()->json([
            'crops'=>$crops,
            'county_crops'=>$county_crops
        ]);
    }

    public function diseases()
    {
        $diseases=Disease::all();
        return response()->json($diseases);
    }

    public function mitigationPlans()
    {
        $plans=MitigationPlan::all();
        return response()->json($plans);
    }
}
