<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // View funcion
    function index()
    {
        $total_category = Category::count();
        $trash_count = Category::onlyTrashed()->count();
        $categories = Category::orderBy('category_name')->get();
        $trash_categories = Category::onlyTrashed()->orderBy('category_name')->get();
        return view('admin.category.index', [
            'categories'=>$categories,
            'trash_count' => $trash_count,
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
            'category_name.required' => 'Please Input Select Name!',
            'category_name.unique' => 'This category-name already exists!',
        ]);

        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);
        $new_category_photo = $request->category_image;
        $extension = $new_category_photo->getClientOriginalExtension();
        $category_name = 'category-'.$category_id.'_'.date('d-m-Y').'.'.$extension;

        Image::make($new_category_photo)->save(base_path('public/uploads/category/'.$category_name));
        Category::find($category_id)->update([
            'category_image'=>$category_name,
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

    // Update function
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

    // Status Function
    public function status($category_id){
        $status = Category::find($category_id)->status;
        if ($status == 0){
             $count_status_active = Category::where('status', 1)->count();
             if ($count_status_active == 3){
                 return back()->with('success', 'Maximum 3 Category can active');
             }
            Category::find($category_id)->update([
                'status'=>1,
            ]);
            return back()->with('success', 'Category Active');
        } else {
            Category::find($category_id)->update([
            'status'=>0,
            ]);
            return back()->with('success', 'Category Deactive');
        }
    }
}
