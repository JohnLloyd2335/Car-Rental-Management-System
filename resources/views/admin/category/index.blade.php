@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="category-container">

            <div class="page-title-container">
                <h3>Category</h3>
            </div>

            @include('admin.includes.session-messages')
            @livewire('admin.category-table-component')
        </div>
    </div>
@endsection
