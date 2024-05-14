@extends('layouts.app')
@section('content')
    <main>
        <div class="hero">
            <div class="hero-text">
                <h1 id="hero-text-main">
                    Rent your <span id="hero-text-highlight">Dream Car</span>
                </h1>
                <p id="hero-text-sub">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas
                    dolores quisquam doloribus quos expedita libero mollitia nobis
                    asperiores nihil. Cum.
                </p>
                <div class="hero-link-container">
                    <a href="{{ route('cars') }}" class="main-button hero-link">Browse Cars</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/hero-image.png') }}" alt="Car Image" />
            </div>
        </div>
    </main>

    <div class="about-section">
        <h3>About Us</h3>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate
            maxime eaque, atque soluta mollitia nesciunt nulla eveniet voluptatum
            rem sit id recusandae debitis ea facilis laboriosam, accusamus modi
            suscipit! Enim quibusdam libero rem sunt ad quia temporibus dolorem
            saepe necessitatibus animi corporis, maxime laboriosam architecto ipsa
            tempore quidem placeat commodi.
        </p>
    </div>

    <div class="services-section">
        <h3>Services</h3>
        <div class="card-container">
            <div class="card card-1">
                <div class="card-image-container card-image-container-1">
                    <img src="{{ asset('images/car-rental.png') }}" alt="Car Rental Image" />
                </div>
                <div class="card-title-container card-title-container-1">
                    <h4>Car Rental</h4>
                </div>
                <div class="card-text-container card-text-container-1">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi
                        distinctio rem quae ratione libero minus earum doloremque vel vero
                        quia, ullam quas dolorem sapiente fuga repellat sint tempore illum
                        fugiat inventore quo quidem pariatur sed praesentium. Beatae
                        eveniet reprehenderit, nesciunt officiis ipsa, consequatur
                        eligendi qui natus numquam ab in placeat?
                    </p>
                </div>
            </div>

            <div class="card card-2">
                <div class="card-image-container card-image-container-2">
                    <img src="{{ asset('images/car-upgrade.png') }}" alt="Car Rental Image" />
                </div>
                <div class="card-title-container card-title-container-2">
                    <h4>Car Upgrade</h4>
                </div>
                <div class="card-text-container card-text-container-2">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi
                        distinctio rem quae ratione libero minus earum doloremque vel vero
                        quia, ullam quas dolorem sapiente fuga repellat sint tempore illum
                        fugiat inventore quo quidem pariatur sed praesentium. Beatae
                        eveniet reprehenderit, nesciunt officiis ipsa, consequatur
                        eligendi qui natus numquam ab in placeat?
                    </p>
                </div>
            </div>

            <div class="card card-3">
                <div class="card-image-container card-image-container-3">
                    <img src="{{ asset('images/car-wash.png') }}" alt="Car Rental Image" />
                </div>
                <div class="card-title-container card-title-container-3">
                    <h4>Car Wash</h4>
                </div>
                <div class="card-text-container card-text-container-3">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi
                        distinctio rem quae ratione libero minus earum doloremque vel vero
                        quia, ullam quas dolorem sapiente fuga repellat sint tempore illum
                        fugiat inventore quo quidem pariatur sed praesentium. Beatae
                        eveniet reprehenderit, nesciunt officiis ipsa, consequatur
                        eligendi qui natus numquam ab in placeat?
                    </p>
                </div>
            </div>

            <div class="card card-4">
                <div class="card-image-container card-image-container-4">
                    <img src="{{ asset('images/change-oil.png') }}" alt="Car Rental Image" />
                </div>
                <div class="card-title-container card-title-container-4">
                    <h4>Change Oil</h4>
                </div>
                <div class="card-text-container card-text-container-4">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi
                        distinctio rem quae ratione libero minus earum doloremque vel vero
                        quia, ullam quas dolorem sapiente fuga repellat sint tempore illum
                        fugiat inventore quo quidem pariatur sed praesentium. Beatae
                        eveniet reprehenderit, nesciunt officiis ipsa, consequatur
                        eligendi qui natus numquam ab in placeat?
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
