<div>
    <div class="cars-hero">
        <div class="search-bar-container">
            <input type="text" id="car-search-bar" placeholder="Search Car..." wire:model="name" />
            <button wire:click="searchCar"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="cars-content">
        <div class="cars-content-header">
            <div class="cars-count">
                <p>{{ $cars->total() }} Available Cars</p>
            </div>
            <div class="cars-filters">
                <div class="car-filter-item">
                    <label>Category</label>
                    <select name="category" wire:model.change="categoryFilter">
                        <option value="ALL">All</option>
                        @forelse ($categories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @empty
                            <option disabled>No Category Found</option>
                        @endforelse
                    </select>
                </div>
                <div class="car-filter-item">
                    <label>Brand</label>
                    <select name="brand" wire:model.change="brandFilter">
                        <option value="ALL">All</option>
                        @forelse ($brands as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @empty
                            <option disabled>No Brand Found</option>
                        @endforelse
                    </select>
                </div>
                <div class="car-filter-item">
                    <label>Rating</label>
                    <select name="cars_rating" id="">
                        <option value="All">All</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                        <option value="No Rating">No Rating</option>
                    </select>
                </div>
                <div class="car-filter-item" wire:click="changePriceOrderByText">
                    <p id="price-filter-text">{{ $labelText }}</p>
                    <i class="fa-solid {{ $labelIcon }}"></i>
                </div>
            </div>
        </div>
        <div class="cars-container">
            @forelse ($cars as $car)
                <div class="car-item">
                    <div class="car-header">
                        @php
                            $car_images = json_decode($car->images);
                        @endphp
                        <img src="{{ asset('storage/car_images/' . $car->id . '/' . $car_images[0]) }}"
                            alt="Car Image" />
                        <div class="car-header-overflow">
                            <a href="{{ route('car.view', $car) }}"><i class="fa-solid fa-eye"></i><span>View More
                                    Details</span></a>
                        </div>
                    </div>
                    <div class="car-body">
                        <div class="car-details-row-1">
                            <p class="car-title">{{ $car->brand->name }}</p>
                            <p class="car-price">{{ '₱' . number_format($car->price_per_day, 2) }}</p>
                        </div>
                        <div class="car-details-row-2">
                            <p class="car-model"> {{ $car->model }}</p>
                            <div class="car-rating">
                                <div class="car-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half"></i>
                                </div>
                                <div class="car-rating-average">
                                    <p>4.5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div id="no-car-item-found">
                    <p>No Car Found.</p>
                </div>
            @endforelse
        </div>

        <div class="cars-pagination">
            {{ $cars->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>
