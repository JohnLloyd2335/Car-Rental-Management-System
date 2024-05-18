@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="car-container">

            <div class="page-title-container">
                <h3>Overdue Rental</h3>
            </div>

            @include('admin.includes.session-messages')

            @livewire('admin.active-rental-table-component')

        </div>
    </div>
@endsection
