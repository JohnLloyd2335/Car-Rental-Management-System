<?php

namespace App\Livewire\Admin;

use App\Models\Rental;
use Livewire\Component;

class RentalActivityReportComponent extends Component
{
    public array $years = [];

    public array $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    public int $total_rental_count = 0;

    public string|int $year;

    public function mount()
    {
        $year = 1999;
        do {
            $year = $year + 1;
            array_push($this->years, $year);
        }
        while ($year <= 2049);

    }

    public function render()
    {
        $rentals = [];
        if (!empty($this->year)) {

            $rentals = $this->countData();
        }

        return view('livewire.admin.rental-activity-report-component', compact('rentals'));
    }

    public function countData(): array
    {
        $this->total_rental_count = 0;

        $rentals = [];

        foreach ($this->months as $month) {
            $data_count = Rental::whereYear('created_at', $this->year)->whereMonth('created_at', $month)->whereIn('status', ['Completed', 'Active'])->count();

            switch ($month) {
                case '1':
                    $rentals['January ' . $this->year] = $data_count;
                    break;
                case '2':
                    $rentals['February ' . $this->year] = $data_count;
                    break;
                case '3':
                    $rentals['March ' . $this->year] = $data_count;
                    break;
                case '4':
                    $rentals['April ' . $this->year] = $data_count;
                    break;
                case '5':
                    $rentals['May ' . $this->year] = $data_count;
                    break;
                case '6':
                    $rentals['June ' . $this->year] = $data_count;
                    break;
                case '7':
                    $rentals['July ' . $this->year] = $data_count;
                    break;
                case '8':
                    $rentals['August ' . $this->year] = $data_count;
                    break;
                case '9':
                    $rentals['September ' . $this->year] = $data_count;
                    break;
                case '10':
                    $rentals['October ' . $this->year] = $data_count;
                    break;
                case '11':
                    $rentals['November ' . $this->year] = $data_count;
                    break;
                case '12':
                    $rentals['December ' . $this->year] = $data_count;
                    break;
                default:
                    echo "Error";
            }

            $this->total_rental_count += $data_count;
        }

        return $rentals;
    }

}
