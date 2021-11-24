<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //    View funcion
    function index()
    {
        $total_category = Category::count();
        $categories = Category::orderBy('category_name')->get();
        $trash_categories = Category::orderBy('category_name')->onlyTrashed()->get();
        return view('admin.category.index', [
            'categories'=>$categories,
            'trash_categories'=>$trash_categories,
            'total_category'=>$total_category,
        ]);
    }

    //    Insert function
    function insert(REQUEST $request)
    {
        $request->validate([
            'category_name' => 'required | unique:categories',
        ], [
            'category_name.required' => 'Category nam koi!',
            'category_name.unique' => 'This category-name already exists!',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Category Added Successfully :)');
    }

    //    Delete function
    function delete($category_id)
    {
        Category::find($category_id)->delete();
        return back()->with('trash', 'Category Trash Successfully :)');
    }

    //    Edit function
    function edit($category_id)
    {
        $category_info = Category::find($category_id);
        return view('admin.category.edit', compact('category_info'));
    }

    //    Update funcion
    function update(Request $request)
    {
        Category::find($request->category_id)->update([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('index')->with('update', 'Category Update Successfully');
    }

    // Restore Function
    function restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('restore', 'Category Restore Successfully!');
    }

    // Permament Delete Function
    function perdelete($category_id){
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->with('perdelete', 'Category Permanently Deleted Successfully!');
    }

    // Mark Delete Function
    function mark_delete(Request $request){
        foreach ($request->mark as $mark_id){
            Category::find($mark_id)->delete();
        }
        return back()->with('mark_delete', 'Marked Category Deleted');
    }
}
