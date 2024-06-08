<div>
    <div class="main-content">
        <div class="reports-container">

            <div class="page-title-container">
                <h3>Customer Feedback Report</h3>
            </div>

            <div class="report-table-container">
                {{-- <div class="report-filter-container">
                    <div class="report-filter-item">
                        <label>Year</label>
                        <select name="year" wire:model.change="year">
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <table id="customerFeedbackReportTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Car</th>
                            <th>Average Rating</th>
                            <th>No of Comments</th>
                            <th>Revenue
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($customer_feedback['cars'] as $feedback)
                            <tr>
                                <td>{{ $feedback['car_info'] }}</td>
                                <td>{{ number_format($feedback['average_rating'], 1) }}</td>
                                <td>{{ $feedback['comment_count'] }}</td>
                                <td>{{ '₱' . number_format($feedback['total_revenue'], 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>


            </div>

            <div class="report-footer-container">
                <div class="amount-container">
                    <div>
                        <label>Total Cars</label>
                        <input type="text" value="{{ $customer_feedback['cars_count'] }}" disabled>
                    </div>
                    <div>
                        <label>Total Avg Rating</label>
                        <input type="text" value="{{ $customer_feedback['total_average_rating'] }}" disabled>
                    </div>
                    <div>
                        <label>Total Number of Comments</label>
                        <input type="text" value="{{ $customer_feedback['total_comments'] }}" disabled>
                    </div>
                    <div>
                        <label>Total Revenue</label>
                        <input type="text" value="{{ '₱' . number_format($customer_feedback['total_revenue'], 2) }}"
                            disabled>
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
