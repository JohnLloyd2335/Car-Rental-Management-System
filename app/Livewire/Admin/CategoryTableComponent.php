<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTableComponent extends Component
{

    use WithPagination;

    public $keywords;

    public $orderBy = "ASC";


    public function render()
    {

        $categories = Category::query();

        if (!empty($this->keywords)) {
            $categories = $categories->where("name", "like", "%" . $this->keywords . "%");
        }

        $categories = $categories->withCount('cars');

        if (!empty($this->orderBy)) {
            if ($this->orderBy == "ASC") {
                $categories = $categories->orderBy("created_at", "ASC");
            } else {
                $categories = $categories->orderBy("created_at", "DESC");
            }

        }

        $categories = $categories->paginate(1);

        return view('livewire.admin.category-table-component', compact('categories'));
    }
}
