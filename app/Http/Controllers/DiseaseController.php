<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\CountyCrop;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    //
    public function index()
    {
        return view('disease.index')->withCounties(County::all());
    }

    public function subCountyDiseases(Request $request)
    {
        $county_crops=CountyCrop::where('sub_county_id',$request->input('sub_county_id'))->get();

        return response()->json([
            'county_crops'=>$county_crops
        ]);
    }

    public function saveNewDisease(Request $request)
    {
        $new=new Disease();
        $new->name=$request->input('name');
        $new->county_crop_id=$request->input('county_crop');
        $new->save();


        return response()->json([
            'diseases'=>Disease::all()
        ]);
    }
}
