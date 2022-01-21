<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Order;
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

    // Order Function
    public function Order(Request $request) {
        $request->validate([
            'payment_method' => 'required',
        ]);
        print_r($request->all());
    }
}
