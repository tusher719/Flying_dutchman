<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome(){
        $categories = Category::orderBy('category_name')->get();
        $categories_active = Category::where('status', 1)->get();
        $products = Product::latest()->get();
        return view('frontend.index', [
            'categories' => $categories,
            'products' => $products,
            'categories_active' => $categories_active,
        ]);
    }

}
