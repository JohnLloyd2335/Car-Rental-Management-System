@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="accessories-container">

            <div class="page-title-container">
                <h3>Accessories</h3>
            </div>

            @include('admin.includes.session-messages')
            @livewire('admin.accessory-table-component')
        </div>
    </div>
@endsection
