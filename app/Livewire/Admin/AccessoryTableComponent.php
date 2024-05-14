<?php

namespace App\Livewire\Admin;

use App\Models\Accessory;
use Livewire\Component;
use Livewire\WithPagination;

class AccessoryTableComponent extends Component
{

    use WithPagination;

    public $keywords;

    public $orderBy = "ASC";

    public function render()
    {

        $accessories = Accessory::query();

        if (!empty($this->keywords)) {
            $accessories = $accessories->where("name", "LIKE", "%" . $this->keywords . "%");
        }

        if (!empty($this->orderBy)) {
            if ($this->orderBy == "ASC") {
                $accessories = $accessories->orderBy("created_at", "ASC");
            } else {
                $accessories = $accessories->orderBy("created_at", "DESC");
            }
        }

        $accessories = $accessories->paginate(1);

        return view('livewire.admin.accessory-table-component', compact('accessories'));
    }
}
