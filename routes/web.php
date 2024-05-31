<?php

use App\Http\Controllers\Admin\AccessoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarAccessoryController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UtilityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController as CustomerRentalController;
use App\Models\Rental;
use App\Models\Review;
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

//Contact Us and About Us Route
Route::view('about-us', 'about-us')->name('aboutUs');
Route::view('contact-us', 'contact-us')->name('contactUs');

//Brawse Car
Route::get('/cars', [CustomerCarController::class, 'index'])->name('cars');

//Handle Authentication Route           s
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/handleLogin', [AuthController::class, 'handleLogin'])->name('handleLlogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegistration'])->name('handleRegistration');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Authenticated Routes
Route::group(['middleware' => 'auth'], function () {

    //Customer Route
    Route::group(['middleware' => 'customer'], function () {

        //View Car
        Route::get('/cars/{car}/view', [CustomerCarController::class, 'show'])->name('car.view');
        //Rent Car
        Route::get('cars/{car}/rent', [CustomerRentalController::class, 'store'])->name('car.rent');

        //Rentals Route
        Route::get('rentals', [CustomerRentalController::class, 'index'])->name('customer.rental.index');
        //Cancel Rental 
        Route::post('rental/pending/{rental}/cancel', [CustomerRentalController::class, 'cancelRental'])->name('customer.rental.pending.cancel');

        //Show Routes for Customer Rentals 
        Route::get('rental/pending/{rental}/view', [CustomerRentalController::class, 'pendingShow'])->name('customer.rental.pending.show');
        Route::get('rental/cancelled/{rental}/view', [CustomerRentalController::class, 'cancelledShow'])->name('customer.rental.cancelled.show');
        Route::get('rental/active/{rental}/view', [CustomerRentalController::class, 'activeShow'])->name('customer.rental.active.show');
        Route::get('rental/overdue/{rental}/view', [CustomerRentalController::class, 'overdueShow'])->name('customer.rental.overdue.show');
        Route::get('rental/completed/{rental}/view', [CustomerRentalController::class, 'completedShow'])->name('customer.rental.completed.show');

        //Add Review Route
        Route::get('rental/{rental}/add-review', [CustomerRentalController::class, 'addReview'])->name('customer.rental.addReview');

        //Store Review
        Route::post('rental/{id}/store-review', [CustomerRentalController::class, 'storeReview'])->name('customer.rental.storeReview');
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

        //Pending Rental Route
        Route::get('rental/pending', [RentalController::class, 'pendingIndex'])->name('rental.pending.index');
        Route::get('rental/pending/{rental}/show', [RentalController::class, 'pendingShow'])->name('rental.pending.show');
        Route::post('rental/pending/{id}/setActive', [RentalController::class, 'approveRental'])->name('rental.pending.setActive');
        Route::post('rental/pending/{rental}/cancel', [RentalController::class, 'cancelRental'])->name('rental.pending.cancel');

        //Cancelled Rental Route
        Route::get('rental/cancelled', [RentalController::class, 'cancelledIndex'])->name('rental.cancelled.index');
        Route::get('rental/cancelled/{rental}/show', [RentalController::class, 'cancelledShow'])->name('rental.cancelled.show');


        //Active Rental Route
        Route::get('rental/active', [RentalController::class, 'activeIndex'])->name('rental.active.index');
        Route::get('rental/active/{rental}/show', [RentalController::class, 'activeShow'])->name('rental.active.show');
        Route::post('rental/{id}/mark-as-completed', [RentalController::class, 'markAsCompleted'])->name('rental.active.markAsCompleted');


        //Overdue Route
        Route::get('rental/overdue', [RentalController::class, 'overdueIndex'])->name('rental.overdue.index');
        Route::get('rental/overdue/{rental}/show', [RentalController::class, 'overdueShow'])->name('rental.overdue.show');

        //Completed Route
        Route::get('rental/completed', [RentalController::class, 'completedIndex'])->name('rental.completed.index');
        Route::get('rental/completed/{rental}/show', [RentalController::class, 'completedShow'])->name('rental.completed.show');

        //Utility Route
        Route::get('utility', [UtilityController::class, 'index'])->name('utility.index');
        Route::get('utility/track-overdue', [UtilityController::class, 'trackOverdueIndex'])->name('utility.track-overdue');
        Route::get('utility/track-overdue/{id}/show', [UtilityController::class, 'overdueShow'])->name('utility.track-overdue.rental.show');
        Route::post('utility/track-overdue/mark-as-overdue', [UtilityController::class, 'markAsOverdue'])->name('utility.track-overdue.rental.markAsOverdue');

        //Report Route
        Route::get('report', [ReportController::class, 'index'])->name('report.index');
        Route::get('report/revenue', [ReportController::class, 'revenueReportIndex'])->name('report.revenue');
        Route::get('report/rental-activity', [ReportController::class, 'rentalActReportIndex'])->name('report.rental-activity');
        Route::get('report/customer-feedback', [ReportController::class, 'customerFeedbackReportIndex'])->name('report.customer-feedback');
        Route::get('report/inventory', [ReportController::class, 'inventoryReportIndex'])->name('report.inventory');
        Route::get('report/overdue', [ReportController::class, 'overdueReportIndex'])->name('report.overdue');
    });
});

//Bug - CSS not working
Route::get('pdf/{rental}/compute-partial', [PDFController::class, 'computePartial'])->name('pdf.compute-partial');

// Route::get('sample', function () {
//     $review = Rental::where('id', 2)->withAvg('review', 'stars')->get();

//     return response()->json($review);
// });