<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Review;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    public function index()
    {
        return view("rental");
    }
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $data = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'car_id' => $request->car_id,
                'total_amount' => $request->total_amount
            ];

            $validator = Validator::make($data, [
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after_or_equal:start_date'],
                'car_id' => ['required'],
                'total_amount' => ['required', 'min:1']
            ]);

            if ($validator->fails()) {

                $fail_validation_response = [
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ];
                return response()->json($fail_validation_response, 422);
            }

            DB::beginTransaction();

            try {
                Rental::create([
                    'car_id' => $request->car_id,
                    'user_id' => auth()->user()->id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'status' => 'Pending',
                ]);

                DB::commit();

                $success_response = [
                    'success' => true,
                    'message' => 'Rental Successfully Set, wait for admin updates'
                ];

                return response()->json($success_response);
            } catch (\Throwable $th) {
                DB::rollBack();

                $fail_response = [
                    'success' => false,
                    'message' => $th->getMessage(),
                ];

                return response()->json($fail_response, 500);
            }
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


        return view("view-pending-rental", compact("rental", "car_images", "car_accessories", "days", "amount"));
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

        return view("view-cancelled-rental", compact("rental", "car_images", "car_accessories", "days", "amount"));
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

        return view("view-active-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

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

        return view("view-overdue-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

    }

    public function completedShow(Rental $rental)
    {
        $rental->load(['user', 'review']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date) == 0 ? '1' : $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays($rental->date_completed);
        $penalty_amount = '₱' . number_format($rental->penalties, 2);

        return view("view-completed-rental", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

    }

    public function addReview(Rental $rental)
    {
        if (!$rental->status == "Completed") {
            return redirect()->back()->with("error", "Invalid Rental Status");
        }

        $rental->load(['user', 'review']);
        $rental->car->load(['category', 'brand', 'car_accessories']);
        $car_images = json_decode($rental->car->images);
        $car_accessories = $rental->car->car_accessories;
        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date) == 0 ? '1' : $start_date->diffInDays($end_date);
        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays($rental->date_completed);
        $penalty_amount = '₱' . number_format($rental->penalties, 2);

        return view("add-rental-review", compact("rental", "car_images", "car_accessories", "days", "amount", "over_due_days", "penalty_amount"));

    }

    public function storeReview($id, Request $request)
    {
        $rental = Rental::findOrFail($id);
        if (!$rental->status == "Completed") {
            return redirect()->route('customer.rental.index')->with("error", "Invalid Rental Status");
        }

        $validator = Validator::make($request->all(), [
            'rental_id' => ['required'],
            'stars' => ['required', 'min:1', 'max:5']
        ]);

        if ($validator->fails()) {

            $failed_validation_response = [
                'success' => false,
                'message' => 'Validation Message',
                'errors' => $validator->errors()
            ];

            return response()->json($failed_validation_response, 422);
        }

        DB::beginTransaction();
        try {

            Review::create([
                'rental_id' => $rental->id,
                'car_id' => $rental->car_id,
                'stars' => $request->stars,
                'comment' => $request->comment
            ]);

            $success_reponse = [
                'success' => true,
                'message' => 'Review Successfully Added'
            ];

            DB::commit();

            return response()->json($success_reponse, 200);
        } catch (\Throwable $th) {

            DB::rollBack();

            $failed_response = [
                'success' => false,
                'message' => $th->getMessage()
            ];

            return response()->json($failed_response, 500);
        }
    }

}
