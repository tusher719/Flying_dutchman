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
    function index()
    {
        $categories = Category::orderBy('category_name')->get();
        $subcategories = SubCategory::orderBy('subcategory_name')->get();
        return view('admin.subcategory.index', compact('categories', 'subcategories'));
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
            Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
//            return back()->with('success', 'SubCategory Added Successfully');
//            return back();
            return view('insert')
        }
    }


    function delete($subcategory_id){
        SubCategory::find($subcategory_id)->delete();
        return back()->with('delete','SubCategory Deleted Successfully :)');
    }


    function edit($subcategory_id){
        $categories = Category::orderBy('category_name')->get();
        $subcategories = SubCategory::find($subcategory_id);
        return view('admin.subcategory.edit', compact('subcategories', 'categories'));
    }


    function update(Request $request){
        SubCategory::find($request->subcategory_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'added_by'=>Auth::id(),
            'updated_at'=>Carbon::now(),
        ]);
        return redirect()->route('index')->with('update','SubCategory Update Successfully!');
    }
}
