<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function welcome(){
        $categories = Category::orderBy('category_name')->get();
        $categories_active = Category::where('status', 1)->get();
        $products = Product::latest()->get();
        return view('frontend.index', [
            'categories' => $categories,
            'products' => $products,
            'categories_active' => $categories_active,
        ]);
    }

    // Product Show Function
    function ProductDetails($product_id){
        $product_singles = Product::find($product_id);
        $available_colors = Inventory::where('product_id', $product_id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
        return view('frontend.product_details', [
            'product_singles' => $product_singles,
            'available_colors' => $available_colors,
        ]);
    }

    // Color $ size Ajax Function
    function getsize(Request $request){
        $sizes = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
        ])->get(['size_id', 'quantity']);
        $str_to_send = '<option value="">---- Select Size ----</option>';
        foreach ($sizes as $size){
            $size_name = Size::find($size->size_id)->size_name;
            $str_to_send .= '<option value="'.$size->size_id.'">'.$size_name.'</option>';
        };
        echo $str_to_send;
    }


    // Quantity Ajax Function
    public function GetQuantity(Request $request){
//        return $request->size_id;
//        return $request->color_id;

        $quantity = Inventory::where([
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
        ])->first(['quantity']);
        return $quantity->quantity;
    }


    // Checkout View
    public function Checkout(Request $request) {
        $discount = $request->discount;
        $delivery = $request->delivery;
        $grand_total = $request->grand_total;
        $countries = Country::select('id', 'name')->get();
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', [
            'countries' => $countries,
            'carts' => $carts,
            'discount' => $discount,
            'delivery' => $delivery,
            'grand_total' => $grand_total,
        ]);
    }

    // 404 Not Found View
    public function NotFound() {
        return view('404');
    }

    // My Account View
    public function MyAccount() {
        $user_info = Auth::user();
        return view('frontend.myaccount', [
            'user_info' => $user_info,
        ]);
    }

}
