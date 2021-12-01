<?php

namespace App\Http\Controllers;

use App\Models\Brand;
//use Faker\Core\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::first()->get();
        return view('admin.brand.index', [
            'brand'=>$brand,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function BrandUpdate(Request $request)
    {
        if ($request->hasFile('brand_img')) {
            $request->validate([
                'brand_img'=>'image | file | max:2048',
            ]);

            $oldImage = Brand::first()->get();
            $path = 'uploads/brand/'.$oldImage[0]->brand_img;
            if (File::exists($path)){
                File::delete($path);
            }



            $new_brand_photo = $request->brand_img;
            $extension = $new_brand_photo->getClientOriginalExtension();
            $brand_img = 'brand_'.uniqid().'.'.$extension;

            Image::make($new_brand_photo)->save(base_path('public/uploads/brand/'.$brand_img));
            Brand::first()->update([
                'brand_img'=>$brand_img,
                'brand_name' => $request->brand_name,
            ]);
            return back()->with('imageupdate', 'Your Brand Photo & Name Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
