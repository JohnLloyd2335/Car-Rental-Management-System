@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="car-container">

            <div class="page-title-container">
                <h3>Add Car</h3>
            </div>

            @include('admin.includes.session-messages')

            <div class="add-car-form-container">
                <form action="{{ route('car.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Category</label>
                            <select name="category" class="@error('category') input-error @enderror">
                                @foreach ($categories as $key => $value)
                                    <option value="{{ $key }}" @selected($key == old('category'))>{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Brand</label>
                            <select name="brand" class="@error('brand') input-error @enderror">
                                @foreach ($brands as $key => $value)
                                    <option value="{{ $key }}" @selected($key == old('category'))>{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <div class="car-form-group-column">
                            <label>Model</label>
                            <input type="text" name="model" class="@error('model') input-error @enderror"
                                value="{{ old('model') }}">
                            @error('model')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <div class="car-form-group-column">
                            <label>Year</label>
                            <input type="text" name="year" id="year" class="@error('year') input-error @enderror"
                                value="{{ old('year') }}">
                            @error('year')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Price Per Day</label>
                            <input type="number" name="price_per_day" class="@error('price_per_day') input-error @enderror"
                                value="{{ old('price_per_day') }}">
                            @error('price_per_day')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Plate Number</label>
                            <input type="text" class="@error('plate_number') input-error @enderror"
                                value="{{ old('plate_number') }}" name="plate_number">
                            @error('plate_number')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        <div class="car-form-group-column">
                            <label>Accessories</label>
                            <select name="accessories[]" id="accessories" multiple="multiple"
                                class="@error('accessories') input-error @enderror">
                                @foreach ($accessories as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('accessories')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Image 1</label>
                            <input type="file" name="image_1" class="@error('image_1') input-error @enderror"
                                accept=".png,.jpeg,.jpg">
                            @error('image_1')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Image 2</label>
                            <input type="file" name="image_2" class="@error('image_2') input-error @enderror"
                                accept=".png,.jpeg,.jpg">
                            @error('image_2')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Image 3</label>
                            <input type="file"name="image_3" class="@error('image_3') input-error @enderror"
                                accept=".png,.jpeg,.jpg">
                            @error('image_3')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Image 4</label>
                            <input type="file" name="image_4" class="@error('image_4') input-error @enderror"
                                accept=".png,.jpeg,.jpg">
                            @error('image_4')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Image 5</label>
                            <input type="file" name="image_5" class="@error('image_5') input-error @enderror"
                                accept=".png,.jpeg,.jpg">
                            @error('image_5')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Description</label>
                            <textarea name="description" class="@error('description') input-error @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="car-form-group">
                        <a class="bg-dark" href="{{ route('car.index') }}">Cancel</a>
                        <button type="submit" class="bg-primary">Save</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
