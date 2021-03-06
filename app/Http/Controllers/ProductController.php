<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductThubnailMultiple;
use App\Models\Size;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admincheck');
    }

    function index(){
        $categories = Category::orderBy('category_name')->get();
        $sub_categories = SubCategory::orderBy('subcategory_name')->get();
        return view('admin.product.add_product', [
            'categories'=>$categories,
            'sub_categories'=>$sub_categories,
        ]);
    }


    // Add Color Function
    function AddColor(){
        $colors = Color::orderBy('color_name')->get();
        return view('admin.product.color', [
            'colors' => $colors,
        ]);
    }

    // Color Insert Function
    function ColorInsert(Request $request){
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Color Added Successfully');
    }


    // Add Size Function
    function AddSize(){
        $sizes = Size::all();
        return view('admin.product.size', [
            'sizes' => $sizes,
        ]);
    }

    // Size Insert Function
    function SizeInsert(Request $request){
        Size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Size Added Successfully');
    }




    function insert(Request $request){
        $product_code = Str::random(2).'-'.rand(0,99999).Str::random(2);
        $discount = ($request->product_price / 100) * $request->discount_percentage;
        $product_id = Product::insertGetId([
           'category_id' => $request->category_id,
           'subcategory_id' => $request->subcategory_id,
           'product_name' => $request->product_name,
           'product_code'=> $product_code,
           'product_price' => $request->product_price,
           'discount_percentage' => $request->discount_percentage,
           'discount_price' => $request->product_price - $discount,
           'product_desp' => $request->product_desp,
           'created_at' => Carbon::now(),
        ]);

        $new_product_photo = $request->product_thumbnail;
        $extension = $new_product_photo->getClientOriginalExtension();
        $product_name = 'product-'.$product_id.'_'.date('d-m-Y').'.'.$extension;

        Image::make($new_product_photo)->resize(800,800)->save(base_path('public/uploads/product/'.$product_name));
        Product::find($product_id)->update([
            'product_thumbnail'=>$product_name,
        ]);

        $start = 1;
        foreach ($request->product_multiple as $single_image){
            $new_image_name = 'product-'.$product_id.'_thumbnail-'.$start.'.'.$single_image->getClientOriginalExtension();
            Image::make($single_image)->resize(800,800)->save(base_path('public/uploads/product/multiple_images/'.$new_image_name));
            ProductThubnailMultiple::insert([
                'product_id' => $product_id,
                'product_multiple_image' => $new_image_name,
                'created_at' => Carbon::now(),
            ]);
            $start++;
        }
        return back()->with('add_product', 'Product Added Successfully');
    }

    // All-Product Function
    function allproduct(){
        $all_products = Product::latest()->get();
        return view('admin.product.all_product', [
            'all_products'=>$all_products,
        ]);
    }



    // Ajax Function
//    public function GetSubCategory($category_id){
//        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
//        return json_encode($subcat);
//    }
}
