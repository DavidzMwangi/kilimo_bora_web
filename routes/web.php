<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function (){


    Route::get('all_counties','CountiesController@index')->name('all_counties');

    //sub county
    Route::get('sub_counties','SubCountyController@index')->name('sub_counties');
    Route::post('save_sub_county','SubCountyController@newSubCounty')->name('save_sub_county');
    Route::get('all_sub_counties','SubCountyController@allSubCounties')->name('all_sub_counties');


    //crops
    Route::get('all_crops','CropsController@index')->name('all_crops');
    Route::post('new_crop','CropsController@newCrop')->name('new_crop');

    //sub county crops
    Route::get('sub_county_crops_view','CropsController@subCountyCropsView')->name('sub_county_crops_view');
    Route::post('get_sub_county_for_crop','CropsController@getSubCountyCrop')->name('get_sub_county_for_crop');
    Route::post('get_sub_county_crops','CropsController@getSubCountyCropRecords')->name('get_sub_county_crops');
});
