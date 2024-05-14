<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Rental System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body>
    <nav>
        <a class="nav-brand" href="#">
            <img src="{{ asset('images/logo/nav-logo.png') }}" alt="Nav Logo" class="nav-logo" />
            <span class="nav-brand-text">CRMS</span>
            <span id="toggle-icon"><i class="fas fa-bars toggle-icon"></i></span>
        </a>
        <ul class="nav-links">
            <li class="nav-link">
                <a href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-link">
                <a href="{{ route('cars') }}">Cars</a>
            </li>
            <li class="nav-link">
                <a href="about.html">About</a>
            </li>
            <li class="nav-link">
                <a href="contact-us.html">Contact Us</a>
            </li>
            @guest
                <li class="nav-link"><a href="{{ route('login') }}">Login/Register</a></li>
            @endguest
            @auth
                <li class="nav-link" id="dropdown-open">
                    <a href="#">{{ auth()->user()->name }}</a>
                    <i class="fa-solid fa-caret-down profile-dropdown-icon"></i>
                </li>
                <div class="profile-dropdown-menu">
                    <div class="profile-info">
                        <img src="{{ asset('images/default_profile_icon.jpg') }}" alt="Default Profile Icon" />
                        <h5>{{ auth()->user()->name }}</h5>
                    </div>
                    <hr />
                    <div class="dropdown-items">
                        <div class="dropdown-item"><a href="">Profile</a></div>
                        <div class="dropdown-item"><a href="">Account Settings</a></div>
                        <div class="dropdown-item"><a id="logout">Logout</a></div>
                    </div>
                </div>
            @endauth
        </ul>
    </nav>

    @yield('content')



    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-brand-container">
                    <h2>Brand Name</h2>
                </div>
                <div class="social-media-container">
                    <div class="social-media-item">
                        <i class="fa-brands fa-facebook fa-2x"></i>
                    </div>
                    <div class="social-media-item">
                        <i class="fa-brands fa-twitter fa-2x"></i>
                    </div>
                    <div class="social-media-item">
                        <i class="fa-brands fa-instagram fa-2x"></i>
                    </div>
                    <div class="social-media-item">
                        <i class="fa-brands fa-telegram fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="footer-section">
                <h4>Links</h4>
                <ul>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Links</h4>
                <ul>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright-section">
            <p>Copyright 2024 Brand Name</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    @livewireScripts
</body>

</html>
