<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
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
//Index Route
Route::get('/', [HomeController::class, 'index'])->name('index');

//Handle Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/handleLogin', [AuthController::class, 'handleLogin'])->name('handleLlogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegistration'])->name('handleRegistration');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Authenticated Routes
Route::group(['middleware' => 'auth'], function () {

    //Customer Route

    //Admin Route
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        //Dashboard Route
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Category Route
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/add', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category/save', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/{id}/update', [CategoryController::class, 'update'])->name('category.update');

        //Brand Route
        Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
        Route::get('brand/add', [BrandController::class, 'create'])->name('brand.create');
        Route::post('brand/save', [BrandController::class, 'store'])->name('brand.store');
        Route::get('brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::put('brand/{id}/update', [BrandController::class, 'update'])->name('brand.update');

    });
});

