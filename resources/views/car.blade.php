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
                    <button class="rent-car-btn">Rent this Car</button>
                    <p>{{ $car->rentals->count() }} people rent this Car</p>
                </div>
            </div>
        </div>

        <div class="car-review-container">
            <h3 class="car-review-title">Car Reviews</h3>
            <div class="reviews">
                <div class="review-item">
                    <div class="review-user-image">
                        <img src="https://placehold.co/100" alt="User Iamge">
                    </div>
                    <div class="review-content">
                        <h4>John Doe</h4>
                        <p id="review-date">April 27, 2024</p>
                        <p id="review-comment">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus molestiae
                            explicabo
                            aliquid excepturi ipsa sapiente aut sequi voluptate tempore voluptatum sit odio magni eos
                            consectetur,
                            autem quos inventore blanditiis beatae veniam! Laudantium excepturi quibusdam saepe sit, eos
                            reprehenderit
                            optio voluptas nihil enim, nesciunt cumque ex molestias ab repudiandae deserunt alias!</p>
                        <div class="review-stars">
                            <div class="car-review-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half"></i>
                            </div>
                            <div class="car-review-rating">
                                <p>4.5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-item">
                    <div class="review-user-image">
                        <img src="https://placehold.co/100" alt="User Iamge">
                    </div>
                    <div class="review-content">
                        <h4>John Doe</h4>
                        <p id="review-date">April 27, 2024</p>
                        <p id="review-comment">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus molestiae
                            explicabo
                            aliquid excepturi ipsa sapiente aut sequi voluptate tempore voluptatum sit odio magni eos
                            consectetur,
                            autem quos inventore blanditiis beatae veniam! Laudantium excepturi quibusdam saepe sit, eos
                            reprehenderit
                            optio voluptas nihil enim, nesciunt cumque ex molestias ab repudiandae deserunt alias!</p>
                        <div class="review-stars">
                            <div class="car-review-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half"></i>
                            </div>
                            <div class="car-review-rating">
                                <p>4.5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-item">
                    <div class="review-user-image">
                        <img src="https://placehold.co/100" alt="User Iamge">
                    </div>
                    <div class="review-content">
                        <h4>John Doe</h4>
                        <p id="review-date">April 27, 2024</p>
                        <p id="review-comment">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus molestiae
                            explicabo
                            aliquid excepturi ipsa sapiente aut sequi voluptate tempore voluptatum sit odio magni eos
                            consectetur,
                            autem quos inventore blanditiis beatae veniam! Laudantium excepturi quibusdam saepe sit, eos
                            reprehenderit
                            optio voluptas nihil enim, nesciunt cumque ex molestias ab repudiandae deserunt alias!</p>
                        <div class="review-stars">
                            <div class="car-review-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half"></i>
                            </div>
                            <div class="car-review-rating">
                                <p>4.5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
                <button class="rent-car-save-btn">Rent</button>
            </div>
        </div>
    </div>

    {{-- Modal --}}
@endsection
