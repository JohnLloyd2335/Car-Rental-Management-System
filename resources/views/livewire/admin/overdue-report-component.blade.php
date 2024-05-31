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
                            <th>No of Rentals</th>
                            <th>Total Overdue Days</th>
                            <th>Total Penalty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data['rental_count'] }}</td>
                            <td>{{ $data['total_days'] }}</td>
                            <td>{{ $data['total_penalty'] }}</td>
                        </tr>
                    </tbody>

                </table>


            </div>

            <div class="report-footer-container">
                <div class="amount-container">

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
