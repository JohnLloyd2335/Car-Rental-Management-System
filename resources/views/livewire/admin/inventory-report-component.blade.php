<div>
    <div class="main-content">
        <div class="reports-container">

            <div class="page-title-container">
                <h3>Inventory Report</h3>
            </div>

            <div class="report-table-container">
                <div class="report-filter-container">
                    <div class="report-filter-item">
                        <label>Category</label>
                        <select name="category" wire:model.change="selectedCategory">
                            <option selected value="All">All</option>
                            @forelse ($categories as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @empty
                                <option selected disabled>No Category Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="report-filter-item">
                        <label>Brand</label>
                        <select name="brand" wire:model.change="selectedBrand">
                            <option selected value="All">All</option>
                            @forelse ($brands as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @empty
                                <option selected disabled>No Brand Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="report-filter-item">
                        <button class="bg-warning" wire:click="clear()"><i
                                class="fas fa-eraser"></i><span>Clear</span></button>
                    </div>
                </div>
                <table id="inventoryReportTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Price per Day</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cars as $car)
                            <tr>
                                <td>{{ $car->category->name }}</td>
                                <td>{{ $car->brand->name }}</td>
                                <td>{{ $car->model }}</td>
                                <td>₱{{ number_format($car->price_per_day, 2) }}</td>
                                <td>
                                    @if ($car->is_available)
                                        <p class="badge-success">Available</p>
                                    @else
                                        <p class="badge-danger">Not Available</p>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Record Found</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
                {{-- 
                <div style="width: 100%">
                    {{ $cars->links() }}
                </div> --}}


            </div>

            <div class="report-footer-container">
                <div class="amount-container">
                    <div>
                        <label>Total Cars</label>
                        <input type="text" id="total_cars" value="{{ $total_cars }}" readonly>
                    </div>
                    <div>
                        <label>Available</label>
                        <input type="text" id="available" value="{{ $available_cars }}" readonly>
                    </div>
                    <div>
                        <label>Unavailable</label>
                        <input type="text" id="unavailable" value="{{ $unavailable_cars }}" readonly>
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
