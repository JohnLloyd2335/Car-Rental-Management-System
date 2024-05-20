<div>
    <div class="main-content">
        <div class="reports-container">

            <div class="page-title-container">
                <h3>Revenue Report</h3>
            </div>

            <div class="report-table-container">
                <div class="report-filter-container">
                    <div class="report-filter-item">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="reportFilterStartDate" wire:model="start_date">
                    </div>
                    <div class="report-filter-item">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="reportFilterEndDate" readonly wire:model="end_date">
                    </div>
                    <div class="report-filter-item">
                        <button class="bg-main" wire:click="search()"><i
                                class="fas fa-search"></i><span>Search</span></button>
                    </div>
                    <div class="report-filter-item">
                        <button class="bg-warning" wire:click="clear()"><i
                                class="fas fa-eraser"></i><span>Clear</span></button>
                    </div>
                </div>
                <table id="revenueReportTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Car Details</th>
                            <th>Rental Details</th>
                            <th>Reservation Date</th>
                            <th>Amount</th>
                            <th>Penalty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_amount = 0;
                        @endphp
                        @forelse ($rentals as $rental)
                            <tr>
                                <td>{{ $rental->user->name }}</td>
                                <td>{{ $rental->car->brand->name }} - {{ $rental->car->model }} -
                                    {{ $rental->car->price_per_day }}</td>
                                <td>{{ $rental->start_date }} - {{ $rental->end_date }}</td>
                                <td>{{ $rental->created_at }}</td>
                                @php
                                    $start_date = Carbon\Carbon::parse($rental->start_date);
                                    $end_date = Carbon\Carbon::parse($rental->end_date);
                                    if (!$start_date->eq($end_date)) {
                                        $days = $start_date->diffInDays($end_date);
                                        $amount = '₱' . number_format($rental->car->price_per_day * $days, 2);
                                    } else {
                                        $days = 1;
                                        $amount = '₱' . number_format($rental->car->price_per_day * days, 2);
                                    }
                                    $total_amount += $rental->car->price_per_day * $days;
                                @endphp
                                <td>{{ $amount }}</td>
                                <td>₱{{ number_format($rental->penalties, 2) }}</td>
                                <td>₱{{ number_format($rental->amount_paid, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Result Found</td>
                            </tr>
                        @endforelse

                        @php

                            $revenue_total = (float) $total_amount + (float) $total_penalties;
                            $revenue_total = number_format($revenue_total, 2);
                            $total_amount = number_format($total_amount, 2);
                        @endphp

                    </tbody>

                </table>


            </div>

            <div class="report-footer-container">
                <div class="amount-container">
                    <div>
                        <label>Amount</label>
                        <input type="text" id="revenueAmount" value="{{ $total_amount }}" readonly>
                    </div>
                    <div>
                        <label>Penalties</label>
                        <input type="text" id="revenuePenaltyAmount"
                            value="{{ number_format($total_penalties, 2) }}" readonly>
                    </div>
                    <div>
                        <label>Total</label>
                        <input type="text" id="revenueTotalAmount" value="₱ {{ $revenue_total }}" readonly>
                    </div>
                </div>

                <div class="action-container">
                    <div>
                        <button class="bg-primary rentalPDF" disabled><i class="fas fa-file-pdf"></i>
                            <span>Print PDF</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
