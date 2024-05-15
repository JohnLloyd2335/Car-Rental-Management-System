<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
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
}
