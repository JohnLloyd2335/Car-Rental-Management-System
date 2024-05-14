@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="brand-container">

            <div class="page-title-container">
                <h3>Brand</h3>
            </div>

            @include('admin.includes.session-messages')

            @livewire('admin.brand-table-component')
        </div>
    </div>
@endsection
