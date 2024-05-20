<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class CarReviewComponent extends Component
{
    use WithPagination;
    public string|int $car_id;

    public function render()
    {

        $car_reviews = Review::with('rental')->whereHas('rental', function ($query) {
            $query->where('car_id', $this->car_id);
        })->paginate(1);


        return view('livewire.admin.car-review-component', compact('car_reviews'));
    }
}
