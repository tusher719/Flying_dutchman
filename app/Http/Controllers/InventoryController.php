<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // Inverntory View
    function AddInventory($product_id){

        $inventorys = Inventory::where('product_id', $product_id)->latest()->get();
        $product_name = Product::find($product_id)->product_name;
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.add_inventory', [
            'inventorys' => $inventorys,
            'product_name' => $product_name,
            'colors' => $colors,
            'sizes' => $sizes,
            'product_id' => $product_id,
        ]);
    }

    // Insert Function
    function InventoryInsert(Request $request){
        if (
            Inventory::where([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
            ])->exists()
        ){
            Inventory::where([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
            ])->increment('quantity', $request->quantity);
            return back()->with('success', 'Product Increment Successfully');
        } else {
            Inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Inventory Added Successfully');
        }
    }
}
