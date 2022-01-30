<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\OrderProductDetails;
use PDF;
use Illuminate\Http\Request;

class InvoiceControlelr extends Controller
{
    public function InvoiceDownload($order_id) {
//        return view('pdf.invoice');
        $cities =  City::where('country_id', $order_id)->get();
        $orders_info = OrderProductDetails::where('order_id', $order_id)->get();
        $order_id = $order_id;
        $order_amount = Order::where('id', $order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', [
            'orders_info' => $orders_info,
            'order_id' => $order_id,
            'order_amount' => $order_amount,
            'cities' => $cities,
        ]);
        return $pdf->download('invoice.pdf');

    }
}
