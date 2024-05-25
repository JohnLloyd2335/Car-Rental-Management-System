@extends('admin.layouts.app')

@section('content')
    <main>
        <div class="main-content">
            <div class="reports-container">

                <div class="page-title-container">
                    <h3>Reports</h3>
                </div>

                <div class="report-list-container">
                    <a class="report-item" href="{{ route('report.revenue') }}">
                        <div class="report-icon-container">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="report-title-container">
                            <p>Revenue Report</p>
                        </div>
                    </a>
                    <a class="report-item" href="{{ route('report.rental-activity') }}">
                        <div class="report-icon-container">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="report-title-container">
                            <p>Rental Activity</p>
                        </div>
                    </a>
                    <a class="report-item" href="#">
                        <div class="report-icon-container">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <div class="report-title-container">
                            <p>Customer Feedback</p>
                        </div>
                    </a>
                    <a class="report-item" href="#">
                        <div class="report-icon-container">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <div class="report-title-container">
                            <p>Inventory Report</p>
                        </div>
                    </a>
                    <a class="report-item" href="#">
                        <div class="report-icon-container">
                            <i class="fa-solid fa-calendar-xmark"></i>
                        </div>
                        <div class="report-title-container">
                            <p>Overdue Report</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
