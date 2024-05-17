<?php

namespace App\Livewire\Admin;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class TrackOverdueRentalTableComponent extends Component
{
    use WithPagination;

    public string $orderBy;

    public string $keywords;

    public array $rental_ids = [];

    // public bool $checkAllLabel;

    public function mount()
    {
        $this->orderBy = "ASC";
        // $this->checkAllLabel = false;
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

        $rental = $rentals->whereDate('end_date', '<=', now());

        $rentals = $rentals->orderBy('id', $this->orderBy);

        $rentals = $rentals->paginate(1);

        return view('livewire.admin.track-overdue-rental-table-component', compact('rentals'));
    }

    public function updateArrayIds(string|int $id)
    {

        if (!in_array($id, $this->rental_ids)) {
            $this->rental_ids[] = $id;
        } else {
            foreach ($this->rental_ids as $key => $value) {
                if ($value == $id) {
                    array_splice($this->rental_ids, $key, 1);
                }
            }
        }

    }

    // public function checkAll()
    // {
    //     $this->rental_ids = [];
    //     $this->checkAllLabel = ($this->checkAllLabel) ? false : true;

    //     if ($this->checkAllLabel) {

    //         $rental_ids = Rental::with('user', 'car')->where('status', 'Active')->whereDate('end_date', '<=', now())->pluck('id')->toArray();

    //         $this->rental_ids = $rental_ids;
    //     } else {
    //         $this->rental_ids = [];
    //     }

    // }
}
