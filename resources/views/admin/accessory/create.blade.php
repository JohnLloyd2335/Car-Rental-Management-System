@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="accessories-container">

            <div class="page-title-container">
                <h3>Add Accessories</h3>
            </div>

            <div class="add-accessories-form-container">
                <form action="{{ route('accessory.store') }}" method="post">
                    @csrf
                    <div class="accessories-form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="@error('name') input-error @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="validation-error-container">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                    </div>
                    <div class="accessories-form-group">
                        <a href="{{ route('accessory.index') }}" class="bg-dark">Cancel</a>
                        <button class="bg-primary">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
