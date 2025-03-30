<?php

use Stripe\Stripe;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginAction');
Route::get('/signup', [AuthController::class, 'showRegisterForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('signupAction');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/collections/abayas' , [HomeController::class, 'abayas'])->name('collections.abayas');
Route::get('/collections/hijabs' , [HomeController::class, 'hijabs'])->name('collections.hijabs');
Route::get('/collections/accessoires' , [HomeController::class, 'accessoires'])->name('collections.accessoires');
Route::get('/collections/kimonos' , [HomeController::class, 'kimonos'])->name('collections.kimonos');

Route::get('/about' , [HomeController::class, 'about'])->name('about');
Route::get('/shop/{id}' , [HomeController::class, 'showProduct'])->name('showProduct');
Route::get('/wishlist' , [HomeController::class, 'wishlist'])->name('wishlist');
Route::post('/wishlist/add', [HomeController::class, 'addWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{productId}', [HomeController::class, 'removeWishlist'])->name('wishlist.remove');
Route::get('/shop/{id}', [HomeController::class, 'showProduct'])->name('product.show');

Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/dashboard' , [DashboardController::class, 'index'])->name('dashboard');
Route::get('/add' , [HomeController::class, 'add'])->name('add');
Route::post('/add' , [HomeController::class, 'store'])->name('store');

Route::get('/test-mail', function () {
    $order = App\Models\Order::first();
    return new App\Mail\OrderConfirmation($order);
});

Route::get('/backstage',[HomeController::class, 'backstage'])->name('backstage');

