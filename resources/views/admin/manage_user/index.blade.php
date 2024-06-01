@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="user-container">

            <div class="page-title-container">
                <h3>Manage Users</h3>
            </div>

            @include('admin.includes.session-messages')

            @livewire('admin.manage-user-table-component')
        </div>
    </div>
@endsection
