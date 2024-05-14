@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="brand-container">

            <div class="page-title-container">
                <h3>Add Brand</h3>
            </div>

            <div class="add-brand-form-container">
                <form action="{{ route('brand.store') }}" method="post">
                    @csrf
                    <div class="brand-form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="@error('name') input-error @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="validation-error-container">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                    </div>
                    <div class="brand-form-group">
                        <a href="{{ route('brand.index') }}" class="bg-dark">Cancel</a>
                        <button class="bg-primary">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
