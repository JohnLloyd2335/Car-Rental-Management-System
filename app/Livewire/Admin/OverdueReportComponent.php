<?php

namespace App\Livewire\Admin;

use App\Models\Rental;
use Carbon\Carbon;
use Livewire\Component;

class OverdueReportComponent extends Component
{
    public string $start_date;
    public string $end_date;
    public string $start_date_value;
    public string $end_date_value;

    public array $data;

    public function mount()
    {

        $total_days = 0;
        $total_penalty = 0;
        $rentals = Rental::whereNotNull('penalties')->get();

        foreach ($rentals as $rental) {
            $end_date = Carbon::parse($rental->end_date);
            $date_returned = Carbon::parse($rental->date_returned);
            $date_diff = $end_date->diffInDays($date_returned);
            $total_days += $date_diff;
        }

        $total_penalty = $rentals->sum('penalties');

        $rental_count = $rentals->count();

        $this->data = [
            'total_days' => $total_days,
            'total_penalty' => '₱' . $total_penalty,
            'rental_count' => $rental_count
        ];
    }


    public function render()
    {

        $total_days = 0;
        $total_penalty = 0;

        $rentals = Rental::whereNotNull('penalties');

        if (!empty($this->start_date_value) && !empty($this->end_date_value)) {
            $rentals = $rentals->whereBetween("created_at", [$this->start_date_value, $this->end_date_value]);
        }

        $rentals = $rentals->get();

        foreach ($rentals as $rental) {
            $end_date = Carbon::parse($rental->end_date);
            $date_returned = Carbon::parse($rental->date_returned);
            $total_days += $end_date->diffInDays($date_returned);
        }

        $total_penalty = $rentals->sum('penalties');

        $rental_count = $rentals->count();

        $this->data = [
            'total_days' => $total_days,
            'total_penalty' => $total_penalty,
            'rental_count' => $rental_count
        ];

        return view('livewire.admin.overdue-report-component');
    }

    public function search()
    {
        $this->start_date_value = $this->start_date;
        $this->end_date_value = $this->end_date;
    }

    public function clear()
    {
        $this->start_date_value = "";
        $this->end_date_value = "";
        $this->start_date = "";
        $this->end_date = "";
    }
}
