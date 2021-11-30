<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        $discount = ($request->product_price / 100) * $request->discount_percentage;
        $product_id = Product::insertGetId([
           'category_id'=>$request->category_id,
           'subcategory_id'=>$request->subcategory_id,
           'product_name'=>$request->product_name,
           'product_code'=>$request->product_code,
           'product_quantity'=>$request->product_quantity,
           'product_price'=>$request->product_price,
           'discount_percentage'=>$request->discount_percentage,
           'discount_price'=>$request->product_price - $discount,
           'product_desp'=>$request->product_desp,
           'created_at'=>Carbon::now(),
        ]);

        $new_product_photo = $request->product_thumbnail;
        $extension = $new_product_photo->getClientOriginalExtension();
        $product_name = 'product-'.$product_id.'_'.date('d-m-Y').'.'.$extension;

        Image::make($new_product_photo)->save(base_path('public/uploads/product/'.$product_name));
        Product::find($product_id)->update([
            'product_thumbnail'=>$product_name,
        ]);
        return back()->with('add_product', 'Product Added Successfully');
    }

    // All-Product Function
    function allproduct(){
        $all_products = Product::latest()->get();
        return view('admin.product.all_product', [
            'all_products'=>$all_products,
        ]);
    }
}
