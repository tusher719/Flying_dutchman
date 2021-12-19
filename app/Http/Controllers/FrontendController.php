<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

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

    // Ajax Function
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

}
