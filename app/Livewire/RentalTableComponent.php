<?php

namespace App\Livewire;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class RentalTableComponent extends Component
{

    use WithPagination;

    public string $orderBy;

    public string $keywords;

    public string $status;

    public function mount()
    {
        $this->orderBy = "ASC";
        $this->status = "All";
    }

    public function render()
    {

        $rentals = Rental::with('user', 'car', 'reviews')->where('user_id', auth()->user()->id);

        if (!empty($this->keywords)) {
            $rentals = $rentals->whereHas('car', function ($query) {
                $query->whereHas('brand', function ($query) {
                    $query->where('name', 'like', '%' . $this->keywords . '%');
                })->orWhere('model', 'like', '%' . $this->keywords . '%');
            });
        }

        if ($this->status != "All") {
            $rentals = $rentals->where('status', $this->status);
        }

        $rentals = $rentals->orderBy('id', $this->orderBy);

        $rentals = $rentals->paginate(1);

        return view('livewire.rental-table-component', compact('rentals'));
    }


}
