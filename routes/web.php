<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('content', ContentController::class);

    Route::resource('product', ProductController::class);
    Route::resource('posts', PostController::class);
    Route::resource('contact', ContactController::class);

});
