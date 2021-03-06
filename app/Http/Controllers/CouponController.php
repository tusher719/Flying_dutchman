<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admincheck', 'verified']);
    }

    // view
    public function Coupon(){
//        $coupons = Coupon::all();
        $coupons = Coupon::orderBy('validity')->get();
        return view('admin.coupon.index', [
            'coupons' => $coupons,
        ]);
    }

    // Insert
    public function CouponInsert(Request $request) {
        Coupon::create($request->except('_token')+[
            'created_at' => Carbon::now(),
            ]);
        return back()->with('success', 'Coupon Added Successfully');
    }
}
