@extends('admin.layouts.app')

@section('content')
    @include('admin.includes.dataTables-css')
    <div class="main-content">
        <div class="brand-container">

            <div class="page-title-container">
                <h3>Brand</h3>
            </div>

            @include('admin.includes.session-messages')

            <div class="brand-table-container">
                <div class="table-button-header-container">
                    <a class="bg-main" href="{{ route('brand.create') }}">Add Brand</a>
                </div>
                <div class="table-container">
                    <table id="brandDataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>No. of Cars</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
