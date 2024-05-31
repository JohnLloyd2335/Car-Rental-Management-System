<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryReportComponent extends Component
{
    use WithPagination;

    public array $categories;
    public string|int $selectedCategory;

    public array $brands;

    public string|int $selectedBrand;

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->selectedCategory = "All";

        $this->brands = Brand::pluck('name', 'id')->toArray();
        $this->selectedBrand = "All";
    }

    public function render()
    {
        $total_cars = 0;
        $available_cars = 0;
        $unavailable_cars = 0;

        $cars = Car::query();

        if (!empty($this->selectedCategory) && $this->selectedCategory != "All") {

            $cars = $cars->whereHas('category', function ($query) {
                $query->where('name', 'like', '%' . $this->selectedCategory . '%');
            });
        }

        if (!empty($this->selectedBrand) && $this->selectedBrand != "All") {

            $cars = $cars->whereHas('brand', function ($query) {
                $query->where('name', 'like', '%' . $this->selectedBrand . '%');
            });
        }


        $cars = $cars->paginate(1);

        return view('livewire.admin.inventory-report-component', compact('cars', 'total_cars', 'available_cars', 'unavailable_cars'));
    }

    public function clear()
    {
        $this->selectedCategory = "All";
        $this->selectedBrand = "All";
    }

}
