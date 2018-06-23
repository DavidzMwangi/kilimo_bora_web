<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\MitigationPlan;
use Illuminate\Http\Request;

class MitigationPlanController extends Controller
{
    //
    public function index()
    {
        return view('mitigation.index')->withCrops(Crop::all())->withPlans(MitigationPlan::all());
    }

    public function newMitigation(Request $request)
    {
        $newMi=new MitigationPlan();
        $newMi->crop_id=$request->input('crop');
        $newMi->mitigation_plan=$request->input('mitigation_plan');
        $newMi->save();


        return redirect()->back();
    }
}
