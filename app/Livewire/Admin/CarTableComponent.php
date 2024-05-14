<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CarTableComponent extends Component
{
    use WithPagination;

    public array $categories = [];
    public array $brands = [];

    public string|int $category_id;

    public string|int $brand_id;

    public string|int $availability;

    public string $more_options;

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->brands = Brand::pluck('name', 'id')->toArray();
        $this->category_id = "ALL";
        $this->brand_id = "ALL";
        $this->availability = "ALL";
        $this->more_options = "Default";

    }

    public function render()
    {

        $cars = Car::with(['category', 'brand']);

        if ($this->category_id != "ALL") {
            $cars = $cars->where("category_id", $this->category_id);
        }

        if ($this->brand_id != "ALL") {
            $cars = $cars->where("brand_id", $this->brand_id);
        }

        if ($this->availability != "ALL") {
            $cars = $cars->where("is_available", $this->availability);
        }

        if ($this->more_options != "Default") {

            if (in_array($this->more_options, ['priceASC', 'priceDESC'])) {

                $order = ($this->more_options == "priceASC") ? 'DESC' : 'ASC';
                $cars = $cars->orderBy('price_per_day', $order);
            }

        }


        $cars = $cars->paginate(5);

        return view('livewire.admin.car-table-component', compact('cars'));
    }

    public function updateCarAvailability(Car $car)
    {

        $car->update([
            'is_available' => !$car->is_available
        ]);

    }
}
