<?php

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\OrdersMainController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GeoLocationUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


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

Route::get('/', 'PostController@index')->name('home');
Route::get('/home', 'PostController@index')->name('homee');
Route::get('/article/{slug}', 'PostController@show')->name('posts.single');
Route::get('/category/{slug}', 'CategoryController@show')->name('categories.single');
Route::get('/tag/{slug}', 'TagController@show')->name('tags.single');
Route::get('/search', 'SearchController@index')->name('search');



Route::get('/getipuser', [GeoLocationUser::class, 'showLocation'])->name('getipuser.showLocation');
Route::get('/getipuserbyid', [GeoLocationUser::class, 'showLocationForIdUSer'])->name('getipuserbyid.showLocationForIdUSer');



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/posts', 'PostController');

    Route::get('/orders', [OrdersMainController::class, 'index'])->name('orders.index');

});

Route::post('/addOrder', [OrdersController::class, 'store'])->name('addOrder.store');
Route::get('/getOrders', [OrdersController::class, 'index'])->name('getOrders.index');
Route::get('/getOrderById', [OrdersController::class, 'edit'])->name('getOrderById.edit');
Route::post('/updateOrder', [OrdersController::class, 'update'])->name('updateOrder.update');
Route::get('/deleteOrderById', [OrdersController::class, 'destroy'])->name('deleteOrderById.destroy');



    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');
    Route::get('/authh', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');

Log::info("ROUTE");
Route::get('cart/show', [CartController::class, 'cartShow'])->name('cart_show.cartShow');
Route::get('cart/add', [CartController::class, 'add_to_cart'])->name('cart_add.addToCart');
Route::get('cart/delete', [CartController::class, 'delete_item'])->name('cart_delete.delete_item');
Route::get('cart/clear', [CartController::class, 'clearAction'])->name('cart_clear.clearAction');

Route::get('category/cart/show', [CartController::class, 'cartShow'])->name('Ccart_show.cartShow');
Route::get('category/cart/add', [CartController::class, 'add_to_cart'])->name('Ccart_add.addToCart');
Route::get('category/cart/delete', [CartController::class, 'delete_item'])->name('Ccart_delete.delete_item');
Route::get('category/cart/clear', [CartController::class, 'clearAction'])->name('Ccart_clear.clearAction');

Route::post('cart/buy', [CartController::class, 'buyProds'])->name('cartBuy.buyProds');




Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');

Auth::routes();

