<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/shop' , [HomeController::class, 'shop'])->name('shop');
Route::get('/about' , [HomeController::class, 'about'])->name('about');
Route::get('/shop/{id}' , [HomeController::class, 'showProduct'])->name('showProduct');
Route::get('/wishlist' , [HomeController::class, 'wishlist'])->name('wishlist');
Route::post('/wishlist/add', [HomeController::class, 'addWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{productId}', [HomeController::class, 'removeWishlist'])->name('wishlist.remove');
Route::get('/shop/{id}', [HomeController::class, 'showProduct'])->name('product.show');


Route::get('/dashboard' , [DashboardController::class, 'index'])->name('dashboard');
Route::get('/add' , [HomeController::class, 'add'])->name('add');
Route::post('/add' , [HomeController::class, 'store'])->name('store');

