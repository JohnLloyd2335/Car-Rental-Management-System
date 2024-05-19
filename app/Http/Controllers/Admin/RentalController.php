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

    public function activeShow(Rental $rental)
    {
        $rental->load(['user']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date) == 0 ? '1' : $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays(now());
        $penalty_amount = '₱' . number_format($over_due_days * $rental->car->price_per_day, 2);

        return view("admin.rental.view-active-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

    }

    public function markAsCompleted($id, Request $request)
    {

        $requiredKeys = ['id', 'penaltyAmount'];

        $failed_validation_response = [
            'success' => false,
            'message' => 'Validation Error',
            'errors' => []
        ];

        foreach ($request->all() as $key => $value) {
            if (!in_array($key, $requiredKeys)) {
                array_push($failed_validation_response['errors'], "The " . $key . " is required.");
            }
        }

        if (count($failed_validation_response['errors']) > 0) {
            return response()->json($failed_validation_response, 422);
        }

        try {
            DB::beginTransaction();

            $rental = Rental::findOrFail($id);

            $penalty = $request->penaltyAmount == 0 ? null : $request->penaltyAmount;

            $start_date = Carbon::parse($rental->start_date);
            $end_date = Carbon::parse($rental->end_date);
            if (!$start_date->eq($end_date)) {
                $days = $start_date->diffInDays($end_date);
                $amount = ($rental->car->price_per_day * $days);
            } else {
                $amount = $rental->car->price_per_day;
            }

            $amount_paid = $penalty + $amount;

            $rental->update([
                'status' => 'Completed',
                'is_paid' => true,
                'amount_paid' => $amount_paid,
                'date_paid' => now(),
                'penalties' => $penalty,
                'date_returned' => now(),
                'date_completed' => now()
            ]);

            DB::commit();

            $success_response = [
                'success' => true,
                'message' => 'Rental Successfully Marked as Completed'
            ];

            return response()->json($success_response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            $failed_response = [
                'success' => false,
                'message' => $th->getMessage(),
            ];

            return response()->json($failed_response, 500);
        }
    }



    public function overdueIndex()
    {
        return view('admin.rental.overdue');
    }

    public function overdueShow(Rental $rental)
    {
        $rental->load(['user']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date) == 0 ? '1' : $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays(now());
        $penalty_amount = '₱' . number_format($over_due_days * $rental->car->price_per_day, 2);

        return view("admin.rental.view-overdue-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

    }

    public function completedIndex()
    {
        return view('admin.rental.completed');
    }

    public function completedShow(Rental $rental)
    {
        $rental->load(['user']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date) == 0 ? '1' : $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays($rental->date_completed);
        $penalty_amount = '₱' . number_format($rental->penalties, 2);

        return view("admin.rental.view-completed-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

    }

}
