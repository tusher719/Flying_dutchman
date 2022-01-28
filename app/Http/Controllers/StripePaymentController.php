<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $insert_info = Stripe\Charge::create ([
            "amount" => $request->grand_total * 100,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        if ($insert_info->balance_transaction) {
            $order_id = Order::where('user_id', Auth::id())->latest()->first()->id;
            Order::find($order_id)->update([
                'payment_status' => 1,
            ]);

            $cart_items = Cart::where('user_id', Auth::id())->get();
            foreach ($cart_items as $cart) {
                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }
            Cart::where('user_id', Auth::id())->delete();
            return redirect('/order/confirmed');
        }

//        Session::flash('success', 'Payment successful!');
//
//        return back();
    }
}
