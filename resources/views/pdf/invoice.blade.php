<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">
        <div class="card-header p-4">
            <div class="float-right">
                <h3 class="mb-0">Invoice #{{ $order_id }}</h3>
                Date: {{ \App\Models\OrderBillingDetails::where('order_id', $order_id)->first()->created_at->format('d-M-Y') }}
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="mb-3">From:</h5>
                    <h3 class="text-dark mb-1">{{ \App\Models\OrderBillingDetails::where('order_id', $order_id)->first()->name }}</h3>
                    <div>{{ \App\Models\OrderBillingDetails::where('order_id', $order_id)->first()->address }}</div>
                    <div>Sikeston,New Delhi {{ \App\Models\OrderBillingDetails::where('order_id', $order_id)->first()->zip }}</div>
                    <div>Email: {{ \App\Models\OrderBillingDetails::where('order_id', $order_id)->first()->email }}</div>
                    <div>Phone: {{ \App\Models\OrderBillingDetails::where('order_id', $order_id)->first()->phone }}</div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Item</th>
                        <th class="right">Price</th>
                        <th class="center">Qty</th>
                        <th class="right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders_info as $key=>$order_info)
                        <tr>
                            <td class="center">{{ $key+1 }}</td>
                            <td class="left strong">{{ $order_info->product_name }}</td>
                            <td class="right">{{ number_format($order_info->product_price,2) }}</td>
                            <td class="center">{{ $order_info->quantity }}</td>
                            <td class="right">{{ number_format($order_info->product_price * $order_info->quantity,2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                </div>
                <div class="col-lg-5 col-sm-6 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                        <tr>
                            <td class="left">
                                <strong class="text-dark">Subtotal</strong>
                            </td>
                            <td class="right" style="background:#ffe4c4;">{{ number_format($order_amount->first()->sub_total, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong class="text-dark">Discount ({{ $order_amount->first()->discount }}%)</strong>
                            </td>
                            <td class="right">{{ number_format($order_amount->first()->sub_total-(($order_amount->first()->sub_total*$order_amount->first()->discount)/100),2) }}</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong class="text-dark">Delivery Charge</strong>
                            </td>
                            <td class="right">{{ number_format($order_amount->first()->delivery_charge, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong class="text-dark">Total Paid</strong> </td>
                            <td class="right"  style="background:#7fffd4;">
                                <strong class="text-dark">{{ number_format($order_amount->first()->grand_total,2) }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong class="text-dark">Your Saved</strong>
                            </td>
                            <td class="right">{{ number_format(($order_amount->first()->sub_total*$order_amount->first()->discount)/100, 2) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
        </div>
    </div>
</div>

</body>
</html>
