<?php

use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarAccessoryController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController as CustomerRentalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController as CustomerCarController;

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
    Route::group(['middleware' => 'customer'], function () {

        //Brawse Car
        Route::get('/cars', [CustomerCarController::class, 'index'])->name('cars');
        //View Car
        Route::get('/cars/{car}/view', [CustomerCarController::class, 'show'])->name('car.view');
        //Rent Car
        Route::get('cars/{car}/rent', [CustomerRentalController::class, 'store'])->name('car.rent');


    });

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

        //Car Accessory Route
        Route::group(['prefix' => 'car'], function () {
            Route::get('accessory', [AccessoryController::class, 'index'])->name('accessory.index');
            Route::get('accessory/add', [AccessoryController::class, 'create'])->name('accessory.create');
            Route::post('accessory/save', [AccessoryController::class, 'store'])->name('accessory.store');
            Route::get('accessory/{id}/edit', [AccessoryController::class, 'edit'])->name('accessory.edit');
            Route::put('accessory/{id}/update', [AccessoryController::class, 'update'])->name('accessory.update');
        });

        //Car Route
        Route::get('car', [CarController::class, 'index'])->name('car.index');
        Route::get('car/{car}/view', [CarController::class, 'show'])->name('car.show');
        Route::get('car/add', [CarController::class, 'create'])->name('car.create');
        Route::post('car/save', [CarController::class, 'store'])->name('car.store');
        Route::get('car/{car}/edit', [CarController::class, 'edit'])->name('car.edit');
        Route::put('car/{car}/update', [CarController::class, 'update'])->name('car.update');
        Route::get('car/filter', [CarController::class, 'filterCarDataTable'])->name('car.filter');
        Route::post('car/{id}/availability/update', [CarController::class, 'toggleCarAvailability'])->name('car.availability.update');

        //Rental Route
        Route::get('rental', [RentalController::class, 'index'])->name('rental.index');
        Route::get('rental/pending', [RentalController::class, 'pendingIndex'])->name('rental.pending.index');
        Route::get('rental/pending/{rental}/show', [RentalController::class, 'pendingShow'])->name('rental.pending.show');
    });
});

