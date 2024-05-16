@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="cards-container">
            <div class="card bg-main">
                <div class="card-icon-container">
                    <i class="fas fa-car"></i>
                </div>
                <div class="card-info-container">
                    <h3>{{ $available_cars_count }}</h3>
                    <h4>AVAILABLE CARS</h4>
                </div>
            </div>

            <div class="card bg-success">
                <div class="card-icon-container">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="card-info-container">
                    <h3>{{ $active_rentals_count }}</h3>
                    <h4>ACTIVE RENTALS</h4>
                </div>
            </div>

            <div class="card bg-dark">
                <div class="card-icon-container">
                    <i class="fas fa-ticket"></i>
                </div>
                <div class="card-info-container">
                    <h3>{{ $pending_rentals_count }}</h3>
                    <h4>PENDING RESERVATION</h4>
                </div>
            </div>

            <div class="card bg-primary">
                <div class="card-icon-container">
                    <i class="fas fa-dollar"></i>
                </div>
                <div class="card-info-container">
                    <h3>{{ $total_revenue }}</h3>
                    <h4>TOTAL REVENUE</h4>
                </div>
            </div>

            <div class="card bg-warning">
                <div class="card-icon-container">
                    <i class="fas fa-star"></i>
                </div>
                <div class="card-info-container">
                    <h3>{{ $car_ratings }}</h3>
                    <h4>CARS AVERAGE RATINGS</h4>
                </div>
            </div>

        </div>

        <div class="analytic-container">
            <div class="revenue-graph-container">
                <div class="graph-header">
                    <p>Revenue by Month</p>
                </div>
                <div class="graph-content">
                    <canvas id="revenueByMonthGraph"></canvas>
                </div>
            </div>

            <div class="revenue-graph-container">
                <div class="graph-header">
                    <p>Car by Category</p>
                </div>
                <div class="graph-content" style="width: 738px; height: 320px;">
                    <canvas id="carCategoryGraph"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('admin/js/chart.js') }}"></script>
    <script src="{{ asset('admin/js/graph-config.js') }}"></script>
@endsection
