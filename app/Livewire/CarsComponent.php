<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CarsComponent extends Component
{
    use WithPagination;

    public array $categories = [];
    public array $brands = [];
    public string|int $categoryFilter;
    public string|int $brandFilter;
    public string $priceFilter;
    public string $labelText;
    public string $labelIcon;
    public string $keywords;
    public string $name;

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id')->toArray();
        $this->brands = Brand::pluck('name', 'id')->toArray();
        $this->categoryFilter = "ALL";
        $this->brandFilter = "ALL";
        $this->priceFilter = "DESC";
        $this->labelText = "Price High to Low";
        $this->labelIcon = "fa-arrow-up";
    }


    public function render()
    {

        $cars = Car::query();

        if (!empty($this->keywords)) {
            $cars = $cars->whereHas('category', function ($query) {
                $query->where('name', 'like', '%' . $this->keywords . '%');
            })->orWhereHas('brand', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->keywords . '%');
            })->orWhere('model', 'LIKE', '%' . $this->keywords . '%');
        }

        if ($this->categoryFilter != "ALL") {
            $cars = $cars->where('category_id', $this->categoryFilter);
        }

        if ($this->brandFilter != "ALL") {
            $cars = $cars->where('brand_id', $this->brandFilter);
        }

        $cars = $cars->with(['category', 'brand']);

        if ($this->priceFilter == "DESC") {
            $cars = $cars->orderBy('price_per_day', $this->priceFilter);
        } else {
            $cars = $cars->orderBy('price_per_day', $this->priceFilter);
        }

        $cars = $cars->paginate(1);

        $this->resetPage();

        return view('livewire.cars-component', compact('cars'));
    }

    public function changePriceOrderByText()
    {
        if ($this->priceFilter == "DESC") {
            $this->priceFilter = "ASC";
            $this->labelText = "Price Low to High";
            $this->labelIcon = "fa-arrow-down";
        } else {
            $this->priceFilter = "DESC";
            $this->labelText = "Price High to Low";
            $this->labelIcon = "fa-arrow-up";
        }
    }

    public function searchCar()
    {
        $this->keywords = $this->name;
    }


}
