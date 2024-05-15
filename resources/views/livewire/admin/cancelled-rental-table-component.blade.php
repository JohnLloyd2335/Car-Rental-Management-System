<div>

    <div class="car-table-container">
        <div class="table-button-header-container">

            <div class="table-filter-container">
                <div>
                    <label>Rental Date</label>
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
            <table id="pendingRentalTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Car Details</th>
                        <th>Reservation Date</th>
                        <th>Start Date</th>
                        <th>End date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                        <tr wire:key="{{ $rental->id }}">
                            <td>{{ $rental->user->name }}</td>
                            <td>{{ $rental->car->brand->name }} - {{ $rental->car->model }} -
                                ₱{{ number_format($rental->car->price_per_day, 2) }}</td>
                            <td>{{ $rental->created_at }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            @php
                                $start_date = Carbon\Carbon::parse($rental->start_date);
                                $end_date = Carbon\Carbon::parse($rental->end_date);
                                $days = $start_date->diffInDays($rental->end_date);
                                $amount = '₱' . number_format($rental->car->price_per_day * $days, 2);
                            @endphp
                            <td>{{ $amount }}</td>
                            <td>
                                <p class="badge-danger">{{ $rental->status }}</p>
                            </td>
                            <td class="td-action">
                                <a href="{{ route('rental.cancelled.show', $rental) }}" class="bg-success"><i
                                        class="fas fa-eye"></i></a>
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
