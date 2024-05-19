<div>
    <link rel="stylesheet" href="{{ asset('admin/css/table.css') }}">

    <div class="car-table-container">
        <div class="page-title-container">
            <h3>Rentals</h3>
        </div>
        <div class="table-button-header-container">

            <div class="table-filter-container">
                <div>
                    <label>Rental Date</label>
                    <select name="rental_date" wire:model.change="orderBy">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </div>
                <div>
                    <label>Status</label>
                    <select name="status" wire:model.change="status">
                        <option value="All">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Active">Active</option>
                        <option value="Overdue">Overdue</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div>
                    <label>Search</label>
                    <input type="text" name="search" wire:model.live.debounce.250ms="keywords">
                </div>
            </div>
        </div>
        <div class="table-container">
            <table id="activeRentalTable" class="display" style="max-width : 1380px">
                <thead>
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Car Details</th>
                            <th>Rental Date</th>
                            <th>Status</th>
                            <th>Reservation Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                        <tr wire:key="{{ $rental->id }}">
                            <td>{{ $rental->user->name }}</td>
                            <td>{{ $rental->car->brand->name }} - {{ $rental->car->model }} -
                                ₱{{ number_format($rental->car->price_per_day, 2) }}</td>
                            <td>{{ $rental->start_date }} - {{ $rental->end_date }}</td>
                            <td>
                                @switch($rental->status)
                                    @case('Pending')
                                        <p class="badge-dark">{{ $rental->status }}</p>
                                    @break

                                    @case('Active')
                                        <p class="badge-primary">{{ $rental->status }}</p>
                                    @break

                                    @case('Cancelled')
                                        <p class="badge-danger">{{ $rental->status }}</p>
                                    @break

                                    @case('Overdue')
                                        <p class="badge-warning">{{ $rental->status }}</p>
                                    @break

                                    @case('Completed')
                                        <p class="badge-success">{{ $rental->status }}</p>
                                    @break

                                    @default
                                        <p class="badge-main">{{ $rental->status }}</p>
                                @endswitch
                            </td>
                            <td>
                                {{ $rental->created_at }}
                            </td>
                            <td>
                                <div class="td-action">

                                    @switch($rental->status)
                                        @case('Pending')
                                            <a href="{{ route('customer.rental.pending.show', $rental) }}"
                                                class="bg-success"><i class="fas fa-eye"></i></a>
                                            <button href="" class="bg-warning"
                                                onclick="cancelRental({{ $rental->id }})"><i class="fas fa-x"></i></button>
                                        @break

                                        @case('Active')
                                            <a href="{{ route('customer.rental.active.show', $rental) }}" class="bg-success"><i
                                                    class="fas fa-eye"></i></a>
                                            <button href="" class="bg-dark" title="Compute Partial"><i
                                                    class="fas fa-file-pdf"></i></button>
                                        @break

                                        @case('Cancelled')
                                            <a href="{{ route('customer.rental.cancelled.show', $rental) }}"
                                                class="bg-success"><i class="fas fa-eye"></i></a>
                                        @break

                                        @case('Overdue')
                                            <a href="{{ route('customer.rental.overdue.show', $rental) }}"
                                                class="bg-success"><i class="fas fa-eye"></i></a>
                                            <button href="{{ route('customer.rental.overdue.show', $rental) }}" class="bg-dark"
                                                title="Compute Partial"><i class="fas fa-file-pdf"></i></button>
                                        @break

                                        @case('Completed')
                                            <a href="{{ route('customer.rental.completed.show', $rental) }}"
                                                class="bg-success"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('customer.rental.addReview', $rental) }}" class="bg-warning"><i
                                                    class="fas fa-star"></i></a>
                                            <button href="" class="bg-dark" title="Print OR"><i
                                                    class="fas fa-file-pdf"></i></button>
                                        @break

                                        @default
                                    @endswitch
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Record Found</td>
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
