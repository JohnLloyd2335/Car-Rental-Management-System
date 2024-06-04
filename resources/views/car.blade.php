@extends('layouts.app')

@section('content')
    <main>
        <div class="car-container">
            <div class="carousel-container">
                <div class="carousel-previous">
                    <button id="carousel-button-prev"><i class="fas fa-caret-left"></i></button>
                </div>
                <div class="carousel-images">
                    <div class="main-car-image active-car-image">

                        @foreach ($car_images as $image)
                            @if ($loop->first)
                                <img src="{{ asset('storage/car_images/' . $car->id . '/' . $image) }}" alt="Car Iamge"
                                    class="carousel-car-image active-carousel-car-image" />
                            @endif
                            <img src="{{ asset('storage/car_images/' . $car->id . '/' . $image) }}" alt="Car Iamge"
                                class="carousel-car-image" />
                        @endforeach
                    </div>
                </div>
                <div class="carousel-next">
                    <button id="carousel-button-next"><i class="fas fa-caret-right"></i></button>
                </div>
            </div>
            <div class="car-info-container">
                <div class="car-title">
                    <h2>{{ $car->brand->name }} {{ $car->model }}</h2>
                </div>

                <div class="car-table-info">
                    <table>
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Model</th>
                                <th>Brand</th>
                                <th>Year</th>
                                <th>Price per Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $car->category->name }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->brand->name }}</td>
                                <td>{{ $car->year }}</td>
                                <td>₱{{ number_format($car->price_per_day, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="car-details-tab">
                    <div class="car-detail-tab-header">
                        <div class="tab-item-header tab-item-header-active" id="car-description-header">
                            <p>Car Description</p>
                        </div>
                        <div class="tab-item-header" id="car-accessories-header">
                            <p>Car Accessories</p>
                        </div>
                    </div>
                    <div class="car-detail-tab-content">
                        <div class="tab-item-content tab-item-content-active" id="car-description-content">
                            <p>
                                {{ $car->description }}
                            </p>
                        </div>
                        <div class="tab-item-content" id="car-accessories-content">
                            <ul>
                                @forelse ($car_accessories as $car_accessory)
                                    <li>{{ $car_accessory->accessory->name }}</li>
                                @empty
                                    <li id="no-accessory-found">No Accessory Found</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="car-other-info-container">
                    @if ($has_rental->count() > 0)
                        <p>You already have {{ $has_rental[0]->status }} Rental on this car</p>
                    @else
                        <button class="rent-car-btn">Rent this Car</button>
                    @endif
                    <p>{{ $completed_rentals_count }} people rent this Car</p>
                </div>
            </div>
        </div>

        @livewire('admin.car-review-component', ['car_id' => $car->id])
    </main>

    {{-- Modal --}}


    <div class="rent-car-modal">
        <div class="rent-car-modal-header">
            <p>Rent Car</p>
            <button class="rent-car-modal-close"><i class="fas fa-x"></i></button>
        </div>
        <div class="rent-car-modal-body">
            <div class="row-1">
                <div class="rent-form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" id="start_date" onchange="setRentEndDateMaxVal()">
                </div>
                <div class="rent-form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" id="end_date" disabled
                        onchange="computeTotalAmount({{ $car->price_per_day }})">
                </div>
            </div>
            <div class="row-2">
                <div class="rent-form-group">
                    <label>Rent per Day</label>
                    <input type="text" name="rent_per_day" id="rent_per_day"
                        value="₱ {{ number_format($car->price_per_day, 2) }}" disabled>
                </div>

                <div class="rent-form-group hideOnMobile">
                    <label>X</label>
                </div>

                <div class="rent-form-group">
                    <label>Days</label>
                    <input type="text" name="rent_per_day" id="days" value="0" disabled>
                </div>

                <div class="rent-form-group">
                    <label>Total Amount</label>
                    <input type="text" name="total_amount" id="total_amount" value="₱ 0.00" disabled>
                </div>
            </div>
        </div>
        <div class="rent-car-modal-footer">
            <div class="row-1">
                <button class="close-rent-modal rent-car-modal-close">Close</button>
                <button class="rent-car-save-btn" onclick="rentCar({{ $car->id }})">Rent</button>
            </div>
        </div>
    </div>

    {{-- Modal --}}
@endsection
