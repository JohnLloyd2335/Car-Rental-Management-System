<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $available_cars_count = Car::where('is_available', true)->count();
        $active_rentals_count = Rental::where('status', 'Active')->count();
        $pending_rentals_count = Rental::where('status', 'Pending')->count();
        $revenue = Rental::sum('amount_paid');
        $penalty_revenue = Rental::sum('penalties');
        $total_revenue = number_format($revenue + $penalty_revenue, 2);
        $car_ratings = Review::avg('stars') ?? 0;

        return view("admin.dashboard", compact('available_cars_count', 'active_rentals_count', 'pending_rentals_count', 'total_revenue', 'car_ratings'));
    }
}
