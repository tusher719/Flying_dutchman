<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admincheck');
    }

    function index()
    {
        $total_subcategory = SubCategory::count();
        $categories = Category::orderBy('category_name')->get();
        $subcategories = SubCategory::orderBy('subcategory_name')->get();
        return view('admin.subcategory.index',([
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'total_subcategory'=>$total_subcategory,
        ]));
    }
    function insert(Request $request)
    {
        if (SubCategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('exist_subcategory', 'SubCategory Already Exist');
    }else{
            $request->validate([
                'category_id' => 'required',
                'subcategory_name' => 'required',
            ]);
            Subcategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'added_by' => Auth::id(),
                'created_at' => Carbon::now(),
            ]);
//            Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
            return back()->with('success', 'SubCategory Added Successfully');
        }
    }

    // Delete
    function delete($subcategory_id){
        SubCategory::find($subcategory_id)->delete();
        return back()->with('delete','SubCategory Deleted Successfully :)');
    }

    //Edit
    function edit($subcategory_id){
        $categories = Category::orderBy('category_name')->get();
        $subcategories = SubCategory::find($subcategory_id);
        return view('admin.subcategory.edit', compact('subcategories', 'categories'));
    }

    // Update
    function update(Request $request){
        if (SubCategory::find($request->subcategory_id)->where('category_id', $request->category_id)->exists()){
            return redirect()->route('index')->with('success','SubCategory & Category Already Exists!');

        } else{
            SubCategory::find($request->subcategory_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'added_by'=>Auth::id(),
                'updated_at'=>Carbon::now(),
            ]);
            return redirect()->route('index')->with('update','SubCategory Update Successfully!');
        }
    }


    // Ajax Function
//    public function GetSubCategory($category_id){
//        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
//        return json_encode($subcat);
//    }
}
