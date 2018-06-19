<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\SubCounty;
use Illuminate\Http\Request;

class SubCountyController extends Controller
{
    //

    public function index()
    {
        $counties=County::all();
        $sub_counties=SubCounty::all();
        return view('sub_county.index')->withSubCounties($sub_counties)->withCounties($counties);
    }

    public function newSubCounty(Request $request)
    {

        $data=new SubCounty();
        $data->name=$request->input('sub_county_name');
        $data->county_id=$request->input('counties');
        $data->save();


        return response()->json([
            'sub_counties'=>SubCounty::all()->load('county')
        ]);
    }

    public function allSubCounties()
    {
        return response()->json([
            'sub_counties'=>SubCounty::all()->load('county')

        ]);
    }
}
