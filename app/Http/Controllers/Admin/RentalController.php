<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return view("admin.rental.index");
    }

    public function pendingIndex()
    {
        return view("admin.rental.pending");
    }

    public function pendingShow(Rental $rental)
    {
        $rental->load(['user']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);


        return view("admin.rental.view-pending-rental", compact("rental", "car_images", "car_accessories", "days", "amount"));
    }
}
