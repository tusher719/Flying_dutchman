<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $categories = Category::orderBy('category_name')->get();
        $sub_categories = SubCategory::orderBy('subcategory_name')->get();
        return view('admin.product.add_product', [
            'categories'=>$categories,
            'sub_categories'=>$sub_categories,
        ]);
    }

    function insert(Request $request){
        Product::insert([
           'category_id'=>$request->category_id,
           'subcategory_id'=>$request->subcategory_id,
           'product_name'=>$request->product_name,
           'product_code'=>$request->product_code,
           'product_quantity'=>$request->product_quantity,
           'product_price'=>$request->product_price,
           'product_desp'=>$request->product_desp,
        ]);

    }
}
