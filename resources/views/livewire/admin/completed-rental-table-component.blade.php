<div>

    <div class="car-table-container">
        <div class="table-button-header-container">

            <div class="table-filter-container">
                <div>
                    <label>Date Completed</label>
                    <select name="category" wire:model.change="orderBy">
                        <option value="ASC">ASC</option>
                        <option value="DESC">DESC</option>
                    </select>
                </div>
                <div>
                    <label>Search</label>
                    <input type="text" name="search" wire:model.live.debounce.250ms="keywords">
                </div>
            </div>
        </div>
        <div class="table-container">
            <table id="completedRentalTable" class="display" style="width:100%">
                <thead>
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Car Details</th>
                            <th>Rental Date</th>
                            <th>Days<p class="small-text">[with overdue]</p>
                            </th>
                            <th>
                                Amount Paid<p class="small-text">[with penalty]</p>
                            </th>
                            <th>Status</th>
                            <th>Date Completed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                        <tr wire:key="{{ $rental->id }}">
                            <td>{{ $rental->user->name }}</td>
                            <td>{{ $rental->car->brand->name }} - {{ $rental->car->model }} -
                                ₱{{ number_format($rental->car->price_per_day, 2) }}</td>
                            <td>{{ $rental->start_date }} - {{ $rental->end_date }}</td>
                            @php
                                $start_date = Carbon\Carbon::parse($rental->start_date);
                                $end_date = Carbon\Carbon::parse($rental->end_date);
                                if (!$start_date->eq($end_date)) {
                                    $days = $start_date->diffInDays($end_date);
                                } else {
                                    $days = 1;
                                }

                                $over_due_days = $end_date->diffInDays($rental->date_completed);

                            @endphp
                            <td>{{ $days + $over_due_days }} </td>
                            <td>{{ '₱' . number_format($rental->amount_paid, 2) }}</td>

                            <td>
                                <p class="badge-primary">{{ $rental->status }}</p>
                            </td>
                            <td>{{ $rental->date_completed }}</td>
                            <td>
                                <div class="td-action">

                                    <a href="{{ route('rental.completed.show', $rental) }}" class="bg-success"><i
                                            class="fas fa-eye"></i></a>
                                    <button class="bg-dark"><i class="fas fa-file-pdf"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div>
                {{ $rentals->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    </div>

</div>
