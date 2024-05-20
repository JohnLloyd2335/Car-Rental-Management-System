@extends('admin.layouts.app')

@section('content')
    <div class="view-car-container">
        <div class="view-car-page-title-container">
            <h4 class="align-self-center">Car Details</h4>
        </div>
        <div class="car-container">

            <div class="carousel-container">
                <div class="carousel-previous">
                    <button id="carousel-button-prev"><i class="fas fa-caret-left"></i></button>
                </div>
                <div class="carousel-images">
                    <div class="main-car-image active-car-image">
                        @foreach ($car_images as $image)
                            @if ($loop->first)
                                <img src="{{ asset('storage/car_images/' . $rental->car->id . '/' . $image) }}"
                                    alt="Car Iamge" class="carousel-car-image active-carousel-car-image" />
                            @endif
                            <img src="{{ asset('storage/car_images/' . $rental->car->id . '/' . $image) }}" alt="Car Iamge"
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
                    <h2>{{ $rental->car->brand->name }} {{ $rental->car->model }}</h2>
                </div>

                <div class="car-table-info">
                    <table>
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Model</th>
                                <th>Brand</th>
                                <th>Year</th>
                                <th>Plate Number</th>
                                <th>Price per Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $rental->car->category->name }}</td>
                                <td>{{ $rental->car->model }}</td>
                                <td>{{ $rental->car->brand->name }}</td>
                                <td>{{ $rental->car->year }}</td>
                                <td>{{ $rental->car->plate_number }}</td>
                                <td>₱{{ number_format($rental->car->price_per_day, 2) }}</td>
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
                                {{ $rental->car->description }}
                            </p>
                        </div>
                        <div class="tab-item-content" id="car-accessories-content">
                            <ul>
                                @foreach ($car_accessories as $accessory)
                                    <li>{{ $accessory->accessory->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="view-car-page-title-container">
            <h4 class="align-self-center">Rental Details</h4>
        </div>

        <div class="rental-info-container">
            <div class="rental-info">
                <div class="info">
                    <span>Customer Name:</span>
                    <p>{{ $rental->user->name }}</p>
                </div>
                <div class="info">
                    <span>Reservation Date:</span>
                    <p>{{ $rental->created_at }}</p>
                </div>
                <div class="info">
                    <span>Rental Days:</span>
                    <p>{{ $days }}</p>
                </div>
                <div class="info">
                    <span>Date Paid:</span>
                    <p>{{ $rental->date_paid }}</p>
                </div>
            </div>
            <div class="rental-info">
                <div class="info">
                    <span>Start Date:</span>
                    <p>{{ $rental->start_date }}</p>
                </div>
                <div class="info">
                    <span>End Date:</span>
                    <p>{{ $rental->end_date }}</p>
                </div>
                <div class="info">
                    <span>Over Due Days:</span>
                    <p>{{ $over_due_days }}</p>
                </div>
                <div class="info">
                    <span>Date Completed:</span>
                    <p>{{ $rental->date_completed }}</p>
                </div>

            </div>
            <div class="rental-info">
                <div class="info">
                    <span>Amount:</span>
                    <p>{{ $amount }}</p>
                </div>
                <div class="info">
                    <span>Penalty Amount:</span>
                    <p>{{ $penalty_amount }}</p>
                </div>
                <div class="info">
                    <span>Amount Paid:</span>
                    <p>{{ '₱' . number_format($rental->amount_paid, 2) }}</p>
                </div>
                <div class="info">
                    <span>Date Returned:</span>
                    <p>{{ $rental->date_returned }}</p>
                </div>
                <div class="info">
                    <span>Status:</span>
                    <p class="badge-primary">{{ $rental->status }}</p>
                </div>
            </div>
        </div>

        <div class="view-car-page-title-container">
            <h4 class="align-self-center">Rental Review</h4>
        </div>

        @if ($rental?->review?->count() > 0)
            <div class="car-review-container">
                <div class="reviews">

                    <div class="review-item">
                        <div class="review-user-image">
                            <img src="https://placehold.co/100" alt="User Iamge">
                        </div>
                        <div class="review-content">
                            <h4>{{ $rental->user->name }}</h4>
                            <p id="review-date">{{ $rental->review->created_at }}</p>
                            <p id="review-comment">{{ $rental->review->comment }}</p>
                            <div class="review-stars">
                                @php
                                    $active_stars = $rental->review->stars;
                                    $unactive_stars = 5 - $active_stars;
                                @endphp
                                <div class="car-review-stars">
                                    @for ($i = 1; $i <= $active_stars; $i++)
                                        <i class="fa-solid fa-star active-stars"></i>
                                    @endfor

                                    @for ($i = 1; $i <= $unactive_stars; $i++)
                                        <i class="fa-solid fa-star uncolored-stars"></i>
                                    @endfor
                                </div>
                                <div class="car-review-rating">
                                    <p>{{ $rental->review->stars }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="view-car-page-title-container">
                <h6 class="align-self-center">No Review Found</h6>
            </div>
        @endif



    </div>
@endsection
