<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class BrandTableComponent extends Component
{
    use WithPagination;

    public $keywords;

    public $orderBy = "ASC";
    public function render()
    {
        $brands = Brand::query();

        if (!empty($this->keywords)) {
            $brands = $brands->where("name", "LIKE", "%" . $this->keywords . "%");
        }

        $brands = $brands->withCount(['cars']);

        if (!empty($this->orderBy)) {
            if ($this->orderBy == "ASC") {
                $brands = $brands->orderBy("created_at", "ASC");
            } else {
                $brands = $brands->orderBy("created_at", "DESC");
            }
        }

        $brands = $brands->paginate(1);

        return view('livewire.admin.brand-table-component', compact('brands'));
    }
}
