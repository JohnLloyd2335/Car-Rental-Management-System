<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarAccessory;
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
        return view('car', compact('car', 'car_accessories', 'car_images'));
    }
}
