<div>
    <div class="main-content">
        <div class="reports-container">

            <div class="page-title-container">
                <h3>Rental Activity Report</h3>
            </div>

            <div class="report-table-container">
                <div class="report-filter-container">
                    <div class="report-filter-item">
                        <label>Year</label>
                        <select name="year" wire:model.change="year">
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table id="revenueReportTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Month & Year</th>
                            <th>Number of Rentals</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rentals as $month_year => $count)
                            <tr>
                                <td>{{ $month_year }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No Records Found</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>


            </div>

            <div class="report-footer-container">
                <div class="amount-container">
                    <div>
                        <label>Total Rentals</label>
                        <input type="text" value="{{ $total_rental_count }}" disabled>
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
