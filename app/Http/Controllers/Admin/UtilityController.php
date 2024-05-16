<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function index()
    {
        return view('admin.utility.index');
    }

    public function trackOverdueIndex()
    {
        return view('admin.utility.track-overdue');
    }

    public function overdueShow($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->load(['user']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays(now());
        $penalty_amount = '₱' . number_format($over_due_days * $rental->car->price_per_day, 2);

        return view("admin.utility.view-overdue-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));
    }
}
