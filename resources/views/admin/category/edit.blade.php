@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="category-container">

            <div class="page-title-container">
                <h3>Edit Category</h3>
            </div>

            <div class="edit-category-form-container">
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="category-form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="@error('name') input-error @enderror"
                            value="{{ $category->name }}">
                        @error('name')
                            <div class="validation-error-container">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                    </div>
                    <div class="category-form-group">
                        <a href="{{ route('category.index') }}" class="bg-dark">Cancel</a>
                        <button class="bg-primary">Update</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
