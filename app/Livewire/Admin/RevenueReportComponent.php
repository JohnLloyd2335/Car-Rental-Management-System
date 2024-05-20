<?php

namespace App\Livewire\Admin;

use App\Models\Rental;
use Livewire\Component;

class RevenueReportComponent extends Component
{
    public string $start_date;
    public string $end_date;
    public string $start_date_value;
    public string $end_date_value;

    public float|double $total_penalties;
    public function render()
    {

        $rentals = Rental::with(['user', 'car']);

        if (!empty($this->start_date_value) && !empty($this->end_date_value)) {
            $rentals->whereBetween("created_at", [$this->start_date_value, $this->end_date_value]);
        }

        $this->total_penalties = $rentals->sum('penalties');

        $rentals = $rentals->get();

        return view('livewire.admin.revenue-report-component', compact('rentals'));
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
