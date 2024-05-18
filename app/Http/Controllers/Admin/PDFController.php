<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function computePartial($id)
    {
        $rental = Rental::findOrFail($id);

        if (!in_array($rental->status, ['Active', 'Overdue'])) {
            return redirect()->back()->with('error', 'Invalid Rental Status');
        }

        $rental->load(['user']);
        $rental->car->load(['category', 'brand']);

        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($rental->end_date);
        $days = $start_date->diffInDays($end_date) == 0 ? '1' : $start_date->diffInDays($end_date);

        $amount = "₱" . number_format($rental->car->price_per_day * $days);
        $over_due_days = $end_date->diffInDays(now()) == 0 ? '1' : $end_date->diffInDays(now());
        $penalty_amount = '₱' . number_format($over_due_days * $rental->car->price_per_day, 2);
        $total_amount = '₱' . number_format(($rental->car->price_per_day * $days) + ($over_due_days * $rental->car->price_per_day), 2);


        $pdf = Pdf::loadView('pdf.compute-partial', compact('rental', 'start_date', 'end_date', 'days', 'amount', 'over_due_days', 'penalty_amount', 'total_amount'));

        $file_name = $rental->user->name . '_' . $rental->id . '-' . now()->format('Y-m-d h:i:s') . ".pdf";

        return $pdf->download($file_name);

        //return view('pdf.compute-partial', compact('rental', 'start_date', 'end_date', 'days', 'amount', 'over_due_days', 'penalty_amount', 'total_amount'));
    }
}
