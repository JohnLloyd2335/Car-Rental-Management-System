@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="reports-container">

            <div class="page-title-container">
                <h3>Utilities</h3>
            </div>

            <div class="report-list-container">
                <a class="report-item" href="{{ route('utility.track-overdue') }}">
                    <div class="report-icon-container">
                        <i class="fa-solid fa-stopwatch"></i>
                    </div>
                    <div class="report-title-container">
                        <p>Track Overdue</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
