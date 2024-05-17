<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function cancelRental(string|int $id, Request $request)
    {

        DB::beginTransaction();
        try {
            $reason = !empty($request->reason) ? $request->reason : null;
            $rental = Rental::findOrFail($id);
            $rental->update([
                'status' => 'Cancelled',
                'cancellation_reason' => $request?->reason,
                'date_cancelled' => now()
            ]);

            DB::commit();

            $success_response = [
                'success' => true,
                'message' => 'Rental Status Successfully Set to Active'
            ];

            return response()->json($success_response);
        } catch (\Throwable $th) {

            $fail_response = [
                'success' => false,
                'message' => $th->getMessage(),
            ];

            DB::rollBack();

            return response()->json($fail_response);
        }
    }

    public function cancelledIndex()
    {
        return view('admin.rental.cancelled');
    }

    public function cancelledShow(Rental $rental)
    {
        $rental->load(['user']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);

        return view("admin.rental.view-cancelled-rental", compact("rental", "car_images", "car_accessories", "days", "amount"));
    }

    public function activeIndex()
    {
        return view("admin.rental.active");
    }

    public function approveRental($id)
    {

        DB::beginTransaction();
        try {

            $rental = Rental::findOrFail($id);
            $rental->update([
                'status' => 'Active',
                'date_approved' => now()
            ]);
            $car_id = $rental->car->id;
            $car = Car::findOrFail($car_id);
            $car->update([
                'is_available' => false
            ]);

            DB::commit();

            $success_response = [
                'success' => true,
                'message' => 'Rental Successfully Set to Active'
            ];

            return response()->json($success_response);
        } catch (\Throwable $th) {
            DB::rollBack();

            $fail_response = [
                'success' => false,
                'message' => $th->getMessage()
            ];

            return response()->json($fail_response);
        }
    }



}
