@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="category-container">

            <div class="page-title-container">
                <h3>Add Category</h3>
            </div>

            <div class="add-category-form-container">
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="category-form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="@error('name') input-error @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="validation-error-container">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                    </div>
                    <div class="category-form-group">
                        <a href="{{ route('category.index') }}" class="bg-dark">Cancel</a>
                        <button class="bg-primary">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
