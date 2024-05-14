<div>

    <div class="car-table-container">
        <div class="table-button-header-container">
            <a class="bg-main" href="{{ route('car.create') }}">Add Car</a>
            <div class="table-filter-container">
                <div>
                    <label>Category</label>
                    <select name="categoryFilter" id="categoryFilter" wire:model.change="category_id">
                        <option value="ALL" selected>ALL</option>
                        @forelse ($categories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}
                            </option>
                        @empty
                            <option disabled>No Category Found</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label>Brand</label>
                    <select name="brand" wire:model.change="brand_id">
                        <option value="ALL">ALL</option>
                        @forelse ($brands as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @empty
                            <option disabled>No Brand Found</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label>Availability</label>
                    <select name="availability" wire:model.change="availability">
                        <option value="ALL">ALL</option>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
                <div>
                    <label>More Options</label>
                    <select name="more_options" wire:model.change="more_options">
                        <option value="Default" selected>Default</option>
                        <option value="priceASC">Price : High to Low</option>
                        <option value="priceDESC">
                            Price : Low to High</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-container">
            <table id="carDataTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price Per Day</th>
                        <th>Availability</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cars as $car)
                        <tr wire:key="{{ $car->id }}">
                            <td>{{ $car->category->name }}</td>
                            <td>{{ $car->brand->name }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ '₱' . number_format($car->price_per_day, 2) }}</td>
                            <td>
                                @if ($car->is_available)
                                    <p class="badge-success">Available</p>
                                @else
                                    <p class="badge-danger">Not Available</p>
                                @endif
                            </td>
                            <td>{{ $car->created_at }}</td>
                            <td>
                                <div class="action-table-buttons">
                                    <a href="{{ route('car.show', $car) }}" class="bg-success"><i
                                            class="fas fa-eye"></i></a>

                                    <a href="{{ route('car.edit', $car) }}" class="bg-primary"><i
                                            class="fas fa-edit"></i></a>

                                    <button class="bg-dark" wire:click="updateCarAvailability({{ $car }})"
                                        data-id="{{ $car->id }}"><i
                                            class="fas {{ $car->is_available ? 'fa-ban' : 'fa-check' }}"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
