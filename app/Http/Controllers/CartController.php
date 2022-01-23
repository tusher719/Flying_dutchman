<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AddToCart(Request $request){
        Cart::insert([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Product Added Card Successfully');
    }

    // Cart Delete
    public function CartDelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    // All Cart Delete
    public function AllCartDelete(){
        Cart::where('user_id', Auth::id())->delete();
        return back();
    }


    // Cart Page View
    public function Cart($coupon_code = ''){
        if ($coupon_code == '') {
            $discount = 0;
        }
        else {
            if (Coupon::where('coupon_name', $coupon_code)->exists()){
                if (Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name', $coupon_code)->first()->validity) {
                    return back()->with('invalid', 'Coupon Code Expried');
                }
                else {
                    $discount = Coupon::where('coupon_name', $coupon_code)->first()->discount;
                }
            }
            else {
                echo 'nai';
                return back()->with('invalid', 'Invalid Coupon Code');
            }
        }

        $carts = Cart::where('user_id', Auth::id())->latest()->get();
        return view('frontend.cart', [
            'carts' => $carts,
            'discount' => $discount,
            'coupon_code' => $coupon_code,
        ]);
    }


    // Cart Update
    public  function CartUpdate(Request $request) {
        foreach ($request->qtybutton as $index_urufe_cart_id => $cart_quantity) {
            Cart::find($index_urufe_cart_id)->update([
                'quantity' => $cart_quantity,
            ]);
            return back()->with('success', 'Cart Quantity Update');
        }
    }
}
