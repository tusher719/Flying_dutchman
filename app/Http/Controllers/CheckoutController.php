<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function GetCityList(Request $request)
    {
        $cities =  City::where('country_id', $request->country_id)->select('id', 'name')->get();
        $str_to_send = "<option> ==== Select City ==== </option>";

        foreach ($cities as $city) {
            $str_to_send .= '<option value="'.$city->id.'">' .$city->name. '</option>';
        }
        echo $str_to_send;

    }
}
