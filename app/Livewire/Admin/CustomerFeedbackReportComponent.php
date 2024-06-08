<?php

namespace App\Livewire\Admin;

use App\Models\Car;
use Livewire\Component;

class CustomerFeedbackReportComponent extends Component
{
    public function render()
    {

        $customer_feedback = [];

        $cars = Car::with('brand', 'reviews', 'rentals')->get();

        $customer_feedback['total_average_rating'] = 0;
        $customer_feedback['total_comments'] = 0;
        $customer_feedback['total_revenue'] = 0;

        foreach ($cars as $key => $car) {

            $customer_feedback['cars'][$key]['car_info'] = $car->brand->name . '-' . $car->model;
            $customer_feedback['cars'][$key]['average_rating'] = 0;
            $customer_feedback['cars'][$key]['comment_count'] = 0;
            $customer_feedback['cars'][$key]['total_revenue'] = 0;
            $rating_sum = 0;

            foreach ($cars[$key]->reviews as $review) {
                $rating_sum += $review->stars;
                $customer_feedback['cars'][$key]['average_rating'] = (float) ($rating_sum / $cars[$key]->reviews->count());

                if (!in_array($review->comment, [null, ''])) {
                    $customer_feedback['cars'][$key]['comment_count'] += 1;
                    $customer_feedback['total_comments'] += 1;
                }
            }

            foreach ($cars[$key]->rentals as $rentals) {
                $customer_feedback['cars'][$key]['total_revenue'] += $rentals->amount_paid;
                $customer_feedback['total_revenue'] += $rentals->amount_paid;
            }

            $customer_feedback['total_average_rating'] += (float) $customer_feedback['cars'][$key]['average_rating'] / $cars->count();
        }

        $customer_feedback['cars_count'] = $cars->count();
        $customer_feedback['cars'] = collect($customer_feedback['cars']);

        return view('livewire.admin.customer-feedback-report-component', compact('customer_feedback'));
    }
}
