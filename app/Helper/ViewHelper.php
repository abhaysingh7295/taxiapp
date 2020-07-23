<?php

use App\PromocodeUsage;
use App\ServiceType;


function currency($value = '')
{
//	if($value == ""){
//		return config('constants.currency').number_format(0, 2, '.', '');
//	} else {
//		return config('constants.currency').number_format($value, 2, '.', '');
//	}
        
        if($value == ""){
		return config('constants.currency').number_format(0, 2, ',', '.');
	} else {
		return config('constants.currency').number_format($value, 2, ',', '.');
	}
}

function distance($value = '')
{
    if($value == ""){
        return "0 ".config('constants.distance', 'Kms');
    }else{
        return $value." ".config('constants.distance', 'Kms');
    }
}

function img($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
		return asset('storage/'.$img);
	}
}

function image($img){
	if($img == ""){
		return asset('main/avatar.jpg');
	}else{
		return asset($img);
	}
}

function promo_used_count($promo_id)
{
	return PromocodeUsage::where('status','USED')->where('promocode_id',$promo_id)->count();
}

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($ch);
    curl_close ($ch);
    return $return;
}

function get_all_service_types()
{
	return ServiceType::all();
}
function get_all_city($id)
{
	return $city = DB::table("cities")->where('country_id',$id)->get();
}
function get_country_name($id)
{
	 $country = DB::table("countries")->where('id',$id)->first();
        return $country->name;
}
function get_company()
{
	return $country = DB::table("carrentcompanies")->get();
    
}
function get_cartype()
{
	return $country = DB::table("carrentcartypes")->get();
       
}
function get_seattype()
{
	return $country = DB::table("vehicle_seattypes")->get();
       
}
function get_company_name($id)
{
	 $country = DB::table("carrentcompanies")->where('id',$id)->first();
        return $country->name;
}
function get_vehicle_makename($id)
{
	 $country = DB::table("vehicles")->where('id',$id)->first();
        return $country->make;
}
function get_vehicle_modelname($id)
{
	 $country = DB::table("vehicles")->where('id',$id)->first();
        return $country->model;
}
function get_seater_name($id)
{
	 $country = DB::table("vehicle_seattypes")->where('id',$id)->first();
        return $country->name;
}
function get_rider_name($id)
{
	 $rider = DB::table("users")->where('id',$id)->first();
        return $rider->first_name." ".$rider->last_name;
}
function get_car_name($id)
{
	 $car = DB::table("carrentcars")->where('id',$id)->first();
        return $car->VehiclesTitle;
}
function get_cartype_name($id)
{
	 $country = DB::table("carrentcartypes")->where('id',$id)->first();
        return $country->name;
}

function demo_mode(){
	if(\Setting::get('demo_mode', 0) == 1) {
        return back()->with('flash_error', 'Disabled for demo purposes! Please contact us at info@thinkin.com');
    }
}

function get_all_language()
{
	return array('en'=>'English','ar'=>'Arabic');
}