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
                        <th>Days</th>
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
                                if (!$start_date->eq($end_date)) {
                                    $days = $start_date->diffInDays($end_date);
                                    $amount = '₱' . number_format($rental->car->price_per_day * $days, 2);
                                } else {
                                    $days = 1;
                                    $amount = '₱' . number_format($rental->car->price_per_day, 2);
                                }
                            @endphp
                            <td>{{ $days }}</td>
                            <td>{{ $amount }}</td>
                            <td>
                                <p class="badge-dark">{{ $rental->status }}</p>
                            </td>
                            <td>
                                <div class="td-action">

                                    <a href="{{ route('rental.pending.show', $rental) }}" class="bg-success"><i
                                            class="fas fa-eye"></i></a>
                                    <button class="bg-primary" onclick="approveRental({{ $rental->id }})"><i
                                            class="fas fa-check"></i></button>
                                    <button class="bg-dark" wire:click="cancelRental({{ $rental->id }})"><i
                                            class="fas fa-x"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div>
                {{ $rentals->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    </div>


    @script
        <script>
            $wire.on('dispatchCancelRental', (id) => {

                Swal.fire({
                    title: 'Are you sure you want to cancel Rental?',
                    text: '',
                    icon: 'warning',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    html: "<div><textarea style='margin: 5px 10px; resize:none;width : 400px;height: 100px;padding: 2px 5px; font-size:22px;' placeholder='Reason' id='reason'></textarea></div>"
                }).then((result) => {
                    if (result.isConfirmed) {

                        let url = `pending/${id}/cancel`;
                        let token = $("meta[name='csrf-token']").attr('content');
                        let reason = $("#reason").val();

                        $.ajax({
                            url: url,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            data: {
                                reason: reason
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success'
                                });

                                window.location.reload();
                            },
                            error: function(error) {
                                Swal.fire({
                                    title: "Server Error",
                                    text: error.responseJSON.message,
                                    icon: "error"
                                });
                            }
                        });

                    }
                });
            });
        </script>
    @endscript
</div>
