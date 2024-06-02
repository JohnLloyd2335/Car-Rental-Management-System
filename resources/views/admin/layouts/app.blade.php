<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRMS</title>
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/table.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar-container">

            <div class="sidebar-close-container" id="closeSideBarMob">
                <i class="fas fa-x"></i>
            </div>

            <div class="brand-container">
                <img src="{{ asset('images/logo/nav-logo.png') }}" alt="">
                <span class="brand-name">CRMS</span>
            </div>


            <div class="link-container"> <a class="link {{ Route::is('dashboard') ? 'active-link' : '' }}"
                    href="{{ route('dashboard') }}"><i class="fas fa-dashboard"></i><span
                        class="text-link">Dashboard</span></a>
                <a class="link {{ Route::is('category.index') ? 'active-link' : '' }}"
                    href="{{ route('category.index') }}"><i class="fas fa-list"></i><span
                        class="text-link">Category</span></a>
                <a class="link {{ Route::is('brand.index') ? 'active-link' : '' }}"
                    href="{{ route('brand.index') }}"><i class="fas fa-copyright"></i><span
                        class="text-link">Brand</span></a>
                <a class="link {{ Route::is('accessory.index') ? 'active-link' : '' }}"
                    href="{{ route('accessory.index') }}"><i class="fas fa-gear"></i><span
                        class="text-link">Accessories</span></a>
                <a class="link {{ Route::is('car.index') ? 'active-link' : '' }}" href="{{ route('car.index') }}"><i
                        class="fas fa-car"></i><span class="text-link">Cars</span></a>
                <a class="link " href="{{ route('rental.index') }}"><i class="fas fa-calendar"></i><span
                        class="text-link">Rentals</span></a>
                <a class="link" href="{{ route('report.index') }}"><i class="fas fa-chart-simple"></i><span
                        class="text-link">Reports</span></a>
                <a class="link {{ Route::is('utility.index') ? 'active-link' : '' }}"
                    href="{{ route('utility.index') }}"><i class="fas fa-wrench"></i><span
                        class="text-link">Utilities</span></a>
                <a class="link {{ Route::is('manage_user.index') ? 'active-link' : '' }}"
                    href="{{ route('manage_user.index') }}"><i class="fas fa-users"></i><span class="text-link">Manage
                        Users</span></a>
            </div>
        </div>

        <main>
            <div class="main-header">
                <div class="toggle-icon-container">
                    <i class="fas fa-bars" id="toggleIcon"></i>
                    <i class="fas fa-bars" id="toggleIconSmallDev"></i>
                </div>
                <div class="user-dropdown-container">
                    <div class="user-dropdown-info" id="user-dropdown">
                        <span>John Doe</span>
                        <i class="fas fa-caret-down"></i>
                    </div>
                    <div class="user-dropdown-items" id="user-dropdown-items">
                        <div class="user-dropdown-item"><a href="#">Change Password</a></div>
                        <div class="user-dropdown-item"><a href="#">Account Settings</a></div>
                        <div class="user-dropdown-item"><a href="#" id="logout">Logout</a></div>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>
    <script src="{{ asset('admin/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/script.js') }}"></script>
    <script src="{{ asset('admin/js/ajax.js') }}"></script>

    @if (Route::is('dashboard'))
        <script src="{{ asset('admin/js/chart.js') }}"></script>
        <script src="{{ asset('admin/js/graph-config.js') }}"></script>
    @endif


    @livewireScripts
</body>

</html>
