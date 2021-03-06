<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceControlelr;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();



// Add User
Route::get('/user', [UserController::class, 'user'])->name('user');
Route::post('/insert/user', [UserController::class, 'InsertUser'])->name('insert_user');


// Frontend
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified', 'admincheck');
Route::get('/', [FrontendController::class, 'welcome']);
Route::get('/product/details/{product_id}', [FrontendController::class, 'ProductDetails'])->name('details');
Route::post('/getsize', [FrontendController::class, 'getsize']);
Route::post('/getquantity', [FrontendController::class, 'GetQuantity']);
Route::get('/checkout', [FrontendController::class, 'Checkout'])->name('checkout')->middleware('auth');
Route::get('/notfound', [FrontendController::class, 'NotFound'])->name('404');
Route::get('/myaccount', [FrontendController::class, 'MyAccount'])->name('my_account')->middleware('auth');

// Register Verified
Route::group(['middleware' => ['verified']], function () {
    Route::get('/myaccount', [FrontendController::class, 'MyAccount'])->name('my_account');
});

// Category
Route::get('/category', [CategoryController::class, 'index'])->name('index');
Route::post('/category/insert', [CategoryController::class, 'insert']);
Route::post('/category/delete/{category_id}', [CategoryController::class, 'delete']);
Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit']);
Route::post('/category/update', [CategoryController::class, 'update']);
Route::get('/category/restore/{category_id}', [CategoryController::class, 'restore']);
Route::post('/category/permanent/delete/{category_id}', [CategoryController::class, 'perdelete']);
Route::post('/mark/delete', [CategoryController::class, 'mark_delete']);
Route::get('/category/status/{category_id}', [CategoryController::class, 'status']);

//Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('index');
Route::post('/subcategory/insert', [SubcategoryController::class, 'insert'])->name('insert');
Route::post('/subcategory/delete/{subcategory_id}', [SubcategoryController::class, 'delete']);
Route::get('/subcategory/edit/{subcategory_id}', [SubcategoryController::class, 'edit']);
Route::post('/subcategory/update', [SubcategoryController::class, 'update']);
//Route::post('/subcategory/ajax/{category_id}', [SubcategoryController::class, 'GetSubCategory']);

//Profile
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/name/update', [ProfileController::class, 'nameupdate']);
Route::post('/password/update', [ProfileController::class, 'passwordupdate']);
Route::post('/photo/update', [ProfileController::class, 'photoupdate']);

//Product
Route::get('/product/add', [ProductController::class, 'index']);
Route::post('/product/insert', [ProductController::class, 'insert']);
Route::get('/product/all', [ProductController::class, 'allproduct']);
//Route::post('/subcategory/ajax/{category_id}', [ProductController::class, 'GetSubCategory']);



// Setting
Route::get('/setting', [SettingController::class, 'index']);
Route::post('/brand/Name', [SettingController::class, 'BrandName']);
Route::post('/brandUpdate', [SettingController::class, 'BrandUpdate']);


// Inventory
Route::get('/add/color', [ProductController::class, 'AddColor']);
Route::post('/color/insert', [ProductController::class, 'ColorInsert']);
Route::get('/add/size', [ProductController::class, 'AddSize']);
Route::post('/size/insert', [ProductController::class, 'SizeInsert']);
Route::get('/inventory/add/{product_id}', [InventoryController::class, 'AddInventory']);
Route::post('/inventory/insert', [InventoryController::class, 'InventoryInsert']);


// Cart
Route::post('/add/to/cart', [CartController::class, 'AddToCart']);
Route::get('/cart/delete/{cart_id}', [CartController::class, 'CartDelete'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'AllCartDelete'])->name('cart.clear');
Route::get('/cart', [CartController::class, 'Cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'CartUpdate'])->name('cart.update');
Route::get('/cart/{coupon_code}', [CartController::class, 'Cart'])->name('cart');


// Coupon
Route::get('/coupon', [CouponController::class, 'Coupon'])->name('coupon');
Route::post('/coupon/insert', [CouponController::class, 'CouponInsert'])->name('coupon.insert');


// Checkout
Route::post('/getCityList', [CheckoutController::class, 'GetCityList'])->name('GetCityList');


// Order
Route::post('/order', [CheckoutController::class, 'Order'])->name('order');
Route::get('/order/confirmed', [CheckoutController::class, 'OrderConfirm'])->name('OrderConfirm');



// SSLCOMMERZ Start
//Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/sslcommerz', [SslCommerzPaymentController::class, 'SSLCommerz'])->name('SSLCommerz');

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Stripe
Route::get('stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


// Invoice
Route::get('/invoice/download/{order_id}', [InvoiceControlelr::class, 'InvoiceDownload'])->name('Invoice.Download');


// The Email Verification Notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//The Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Resending The Verification Email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
