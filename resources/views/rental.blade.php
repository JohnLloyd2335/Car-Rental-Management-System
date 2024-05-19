@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="car-container">


            @include('admin.includes.session-messages')

            @livewire('rental-table-component')
        </div>
    </div>
@endsection
