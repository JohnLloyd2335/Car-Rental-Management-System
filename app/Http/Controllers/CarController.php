<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarAccessory;
use App\Models\Rental;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('cars');
    }

    public function show(Car $car)
    {

        $car->load(['category', 'brand', 'car_accessories', 'rentals']);
        $car_accessories = CarAccessory::with('accessory')->where('car_id', $car->id)->get();
        $car_images = json_decode($car->images, true);
        $has_rental = Rental::where('user_id', auth()->user()->id)->where('car_id', $car->id)->whereIn('status', ['Pending', 'Active', 'Overdue'])->get();
        $completed_rentals_count = Rental::where('car_id', $car->id)->whereIn('status', ['Active', 'Overdue', 'Completed'])->count();

        return view('car', compact('car', 'car_accessories', 'car_images', 'has_rental', 'completed_rentals_count'));
    }
}
