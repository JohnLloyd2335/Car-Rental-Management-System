@extends('layouts.app')

@section('content')
    <main>
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
                                <img src="{{ asset('storage/car_images/' . $rental->car->id . '/' . $image) }}"
                                    alt="Car Iamge" class="carousel-car-image" />
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

        @if ($rental->reviews->count() > 0)
            <div class="view-car-page-title-container">
                <h4 class="align-self-center">Review</h4>
            </div>


            <div class="car-review-container">
                <div class="reviews">

                    @foreach ($rental->reviews as $review)
                        <div class="review-item">
                            <div class="review-user-image">
                                <img src="https://placehold.co/100" alt="User Iamge">
                            </div>
                            <div class="review-content">
                                <h4>{{ $review->rental->user->name }}</h4>
                                <p id="review-date">{{ $review->created_at }}</p>
                                <p id="review-comment">
                                    {{ $review->comment }}
                                </p>
                                <div class="review-stars">
                                    <div class="car-review-stars">

                                        @php
                                            $ratings = $review->stars;
                                            $uncolored_stars = 5 - $ratings;
                                        @endphp
                                        @for ($i = 0; $i < $ratings; $i++)
                                            <i class="fa-solid fa-star active-stars"></i>
                                        @endfor
                                        @for ($i = 0; $i < $uncolored_stars; $i++)
                                            <i class="fa-solid fa-star uncolored-stars"></i>
                                        @endfor


                                    </div>
                                    <div class="car-review-rating">
                                        <p>{{ $review->stars }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        @else
            <div class="view-car-page-title-container">
                <h4 class="align-self-center">Add Review</h4>
            </div>

            <div class="add-review-container">
                <div class="review-container-row">
                    <div class="stars-container">
                        <i class="fas fa-star star" data-rating="1"></i>
                        <i class="fas fa-star star" data-rating="2"></i>
                        <i class="fas fa-star star" data-rating="3"></i>
                        <i class="fas fa-star star" data-rating="4"></i>
                        <i class="fas fa-star star" data-rating="5"></i>
                    </div>
                    <div class="review-count-container">
                        <span id="review-count">0 star</span>
                        <input type="hidden" id="review-count-field" value="0" required>
                    </div>
                </div>


                <div class="review-container-row">
                    <div class="review-message-container">
                        <label>Comment</label>
                        <textarea name="comment" placeholder="Comment..." id="comment"></textarea>
                    </div>
                </div>

                <div class="review-container-row">
                    <button class="bg bg-main" onclick="addRentalReview({{ $rental->id }})">Submit</button>
                </div>
            </div>
        @endif
    </main>
@endsection
