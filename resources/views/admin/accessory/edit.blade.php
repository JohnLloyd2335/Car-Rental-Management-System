@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="accessories-container">

            <div class="page-title-container">
                <h3>Edit Accessory</h3>
            </div>

            <div class="edit-accessories-form-container">
                <form action="{{ route('accessory.update', $accessory->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="accessories-form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="@error('name') input-error @enderror"
                            value="{{ $accessory->name }}">
                        @error('name')
                            <div class="validation-error-container">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                    </div>
                    <div class="accessories-form-group">
                        <a href="{{ route('accessory.index') }}" class="bg-dark">Cancel</a>
                        <button class="bg-primary">Update</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
