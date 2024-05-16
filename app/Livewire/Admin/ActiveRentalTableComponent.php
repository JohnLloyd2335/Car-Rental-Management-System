<?php

namespace App\Livewire\Admin;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ActiveRentalTableComponent extends Component
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

        $rentals = Rental::with('user', 'car')->where('status', 'Active');

        if (!empty($this->keywords)) {
            $rentals = $rentals->whereHas('car', function ($query) {
                $query->whereHas('brand', function ($query) {
                    $query->where('name', 'like', '%' . $this->keywords . '%');
                })->orWhere('model', 'like', '%' . $this->keywords . '%');
            });
        }

        $rentals = $rentals->orderBy('id', $this->orderBy);

        $rentals = $rentals->paginate(1);

        return view('livewire.admin.active-rental-table-component', compact('rentals'));
    }
}
