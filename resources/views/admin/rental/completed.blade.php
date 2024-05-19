@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="car-container">

            <div class="page-title-container">
                <h3>Completed Rental</h3>
            </div>

            @include('admin.includes.session-messages')

            @livewire('admin.completed-rental-table-component')

        </div>
    </div>
@endsection
