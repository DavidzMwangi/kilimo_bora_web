<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\CountyCrop;
use App\Models\Crop;
use App\Models\SubCounty;
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

    public function getSubCountyCrop(Request $request)
    {
        $subcounties=SubCounty::where('county_id',$request->input('county_id'))->get();

        return response()->json([
            'sub_counties'=>$subcounties->load('county')
        ]);
    }

    public function getSubCountyCropRecords(Request $request)
    {
        $records=CountyCrop::where('sub_county_id',$request->input('sub_county_id'))->get();

        return response()->json([
            'records'=>$records->load(['crop','subCounty'])
        ]);
    }
}
