@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="rental-container">

            <div class="page-title-container">
                <h3>Rental Module</h3>
            </div>

            <div class="rental-module-container">

                <a class="module bg-dark" href="{{ route('rental.pending.index') }}">
                    <div class="module-icon-container">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="module-text-container">
                        <p>Pending Rental</p>
                    </div>
                </a>

                <a class="module bg-primary">
                    <div class="module-icon-container">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="module-text-container">
                        <p>Active Rental</p>
                    </div>
                </a>

                <a class="module bg-danger" href="{{ route('rental.cancelled.index') }}">
                    <div class="module-icon-container">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <div class="module-text-container">
                        <p>Cancelled Rental</p>
                    </div>
                </a>

                <a class="module bg-warning" href="#">
                    <div class="module-icon-container">
                        <i class="fas fa-calendar-minus"></i>
                    </div>
                    <div class="module-text-container">
                        <p>Overdue Rental</p>
                    </div>
                </a>

                <a class="module bg-success" href="#">
                    <div class="module-icon-container">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="module-text-container">
                        <p>Completed Rental</p>
                    </div>
                </a>


            </div>
        </div>
    </div>
@endsection
