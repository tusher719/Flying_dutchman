<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderBillingDetails;
use App\Models\OrderProductDetails;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function GetCityList(Request $request)
    {
        $cities =  City::where('country_id', $request->country_id)->select('id', 'name')->get();
        $str_to_send = "<option> ==== Select City ==== </option>";

        foreach ($cities as $city) {
            $str_to_send .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $str_to_send;
    }

    // Order Function
    public function Order(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        //        echo $request->delivery_charge;
        //        die();


        // Order Insert
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'sub_total' => $request->sub_total,
            'grand_total' => $request->total + $request->delivery_charge,
            'discount' => $request->discount,
            'delivery_charge' => $request->delivery_charge,
            'payment_method' => $request->payment_method,
            'created_at' => Carbon::now(),
        ]);

        // Order_Billing_Details
        OrderBillingDetails::insert([
            'order_id' => $order_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        // Order_Product_Details
        $cart_items = Cart::where('user_id', Auth::id())->get();
        foreach ($cart_items as $cart) {
            OrderProductDetails::insert([
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'product_name' => $cart->relation_to_products->product_name,
                'product_price' => $cart->relation_to_products->discount_price,
                'quantity' => $cart->quantity,
                'created_at' => Carbon::now(),
            ]);
        }

        if ($request->payment_method == 1) {
            foreach ($cart_items as $cart) {
                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('OrderConfirm');
        }
        elseif ($request->payment_method == 2) {
            return redirect()->route('SSLCommerz');
        }

        return back();
    }

    // Order Confirm
    public function OrderConfirm() {
        return view('frontend.confirm');
    }
}
