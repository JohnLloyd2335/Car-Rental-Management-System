<?php

namespace App\Livewire\Admin;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class OverdueRentalTableComponent extends Component
{

    use WithPagination;

    public string $orderBy;

    public string $keywords;

    public function mount()
    {
        $this->orderBy = "ASC";
    }

    public function render()
    {

        $rentals = Rental::with('user', 'car')->where('status', 'Overdue');

        if (!empty($this->keywords)) {
            $rentals = $rentals->whereHas('car', function ($query) {
                $query->whereHas('brand', function ($query) {
                    $query->where('name', 'like', '%' . $this->keywords . '%');
                })->orWhere('model', 'like', '%' . $this->keywords . '%');
            });
        }

        $rentals = $rentals->orderBy('id', $this->orderBy);

        $rentals = $rentals->paginate(1);


        return view('livewire.admin.overdue-rental-table-component', compact('rentals'));
    }
}
