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

// Frontend
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'welcome']);

// Category
Route::get('/user', [UserController::class, 'user'])->name('user');
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

//Profile
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/name/update', [ProfileController::class, 'nameupdate']);
Route::post('/password/update', [ProfileController::class, 'passwordupdate']);
Route::post('/photo/update', [ProfileController::class, 'photoupdate']);

//Product
Route::get('/product/add', [ProductController::class, 'index']);
Route::post('/product/insert', [ProductController::class, 'insert']);
Route::get('/product/all', [ProductController::class, 'allproduct']);


// Setting
Route::get('/setting', [SettingController::class, 'index']);
Route::post('/brand/Name', [SettingController::class, 'BrandName']);
Route::post('/brandUpdate', [SettingController::class, 'BrandUpdate']);


// Inventory
Route::get('/add/color', [ProductController::class, 'AddColor']);
Route::post('/color/insert', [ProductController::class, 'ColorInsert']);
Route::get('/add/size', [ProductController::class, 'AddSize']);
Route::post('/size/insert', [ProductController::class, 'SizeInsert']);
