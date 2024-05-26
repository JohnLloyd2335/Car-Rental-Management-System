<?php

namespace App\Livewire\Admin;

use App\Models\Car;
use Livewire\Component;

class CustomerFeedbackReportComponent extends Component
{
    public function render()
    {

        $customer_feedback = [];

        $cars = Car::with([
            'rentals' => function ($query) {
                $query->with('review');
            },
            'brand'
        ])->get();

        $car_avg_rating = 0;
        $comment_count = 0;
        $total_revenue = 0;


        for ($i = 0; $i <= (count($cars) - 1); $i++) {

            $total_revenue = 0;

            foreach ($cars[$i]->rentals as $rental) {
                $car_avg_rating += ($rental?->review?->stars == null) ? 0 : $rental->review->stars;
                $comment_count += ($rental?->review?->comment == null) ? 0 : 1;
                $total_revenue += $rental->amount_paid;
            }

            $customer_feedback[$i] = [
                'car_info' => $cars[$i]->brand->name . ' - ' . $cars[$i]->model,
                'average_rating' => $car_avg_rating,
                'comment_count' => $comment_count,
                'total_revenue' => $total_revenue
            ];
        }

        $cars_count = count($cars);
        $total_avg_rating = 'NaN';
        $total_comments = 0;
        $total_revenue = 0;

        foreach ($customer_feedback as $feedback) {
            $total_comments += (int) $feedback['comment_count'];
        }

        foreach ($customer_feedback as $feedback) {
            $total_revenue += (int) $feedback['total_revenue'];
        }

        return view('livewire.admin.customer-feedback-report-component', compact('customer_feedback', 'cars_count', 'total_avg_rating', 'total_comments', 'total_revenue'));
    }
}
