<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Crop;
use Illuminate\Http\Request;

class CropsController extends Controller
{
    //
    public function index()
    {
        $crops=Crop::all();
        return view('crop.index')->withCrops($crops);
    }

    public function newCrop(Request $request)
    {
        $newC=new Crop();
        $newC->name=$request->input('crop_name');
        $newC->save();


        return redirect()->back();
    }

    public function subCountyCropsView()
    {
        $counties=County::all();
        return view('crop.sub_county_crops')->withCounties($counties);
    }
}
