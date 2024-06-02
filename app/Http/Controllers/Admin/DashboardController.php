<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
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
        $completed_rentals_count = Rental::where('status', 'Completed')->count();
        $revenue = Rental::sum('amount_paid');
        $penalty_revenue = Rental::sum('penalties');
        $total_revenue = number_format($revenue + $penalty_revenue, 2);
        $car_ratings = number_format(Review::avg('stars') ?? 0, 1);

        return view("admin.dashboard", compact('available_cars_count', 'active_rentals_count', 'pending_rentals_count', 'total_revenue', 'car_ratings', 'completed_rentals_count'));
    }

    public function getRevenueGraphData(Request $request)
    {
        if ($request->ajax()) {
            $currentYearRevenueData = [];
            $lastYearRevenueData = [];
            $currentYear = date('Y');
            $lastYear = date('Y') - 1;

            for ($i = 0; $i <= 11; $i++) {

                $currentYearRevenueData[$i] = 0;

                $currentYearRentals = Rental::where('status', 'Completed')->whereMonth('date_completed', $i + 1)->whereYear('date_completed', $currentYear)->get();

                foreach ($currentYearRentals as $rental) {

                    $currentYearRevenueData[$i] += $rental->amount_paid;
                }

                $lastYearRevenueData[$i] = 0;

                $lastYearRentals = Rental::where('status', 'Completed')->whereMonth('date_completed', $i + 1)->whereYear('date_completed', $lastYear)->get();

                foreach ($lastYearRentals as $rental) {

                    $lastYearRevenueData[$i] += $rental->amount_paid;
                }

            }

            $revenueData = [
                '2023' => $lastYearRevenueData,
                '2024' => $currentYearRevenueData
            ];

            return response()->json($revenueData);
        }


    }

    public function getCarCategoryGraphData(Request $request)
    {

        if ($request->ajax()) {

            $car_categories = Category::pluck('name', 'id')->toArray();
            $cars = Car::all();

            $categoryData = [];

            foreach ($car_categories as $key => $value) {

                $categoryData[$value] = 0;

                foreach ($cars as $car) {

                    if ($key == $car->category_id) {
                        $categoryData[$value] += 1;
                    }

                }

            }

            return response()->json($categoryData);
        }
    }
}
