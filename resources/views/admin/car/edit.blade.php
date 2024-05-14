@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="car-container">

            <div class="page-title-container">
                <h3>Edit Car</h3>
            </div>

            @include('admin.includes.session-messages')

            <div class="add-car-form-container">
                <form action="{{ route('car.update', $car) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Category</label>
                            <select name="category" class="@error('category') input-error @enderror">
                                @foreach ($categories as $key => $value)
                                    <option value="{{ $key }}" @selected($key == $car->category_id)>{{ $value }}
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
                                    <option value="{{ $key }}" @selected($key == $car->brand_id)>{{ $value }}
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
                                value="{{ $car->model }}">
                            @error('model')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>


                    </div>

                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Year</label>
                            <input type="text" name="year" id="year" class="@error('year') input-error @enderror"
                                value="{{ $car->year }}">
                            @error('year')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Price Per Day</label>
                            <input type="number" name="price_per_day" class="@error('price_per_day') input-error @enderror"
                                value="{{ $car->price_per_day }}">
                            @error('price_per_day')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="car-form-group-column">
                            <label>Plate Number</label>
                            <input type="text" class="@error('plate_number') input-error @enderror"
                                value="{{ $car->plate_number }}" name="plate_number">
                            @error('plate_number')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>


                    </div>


                    <div class="car-form-group">
                        <div class="car-form-group-column">
                            <label>Description</label>
                            <textarea name="description" class="@error('description') input-error @enderror">{{ $car->description }}</textarea>
                            @error('description')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="car-form-group">
                        <a class="bg-dark" href="{{ route('car.index') }}">Cancel</a>
                        <button type="submit" class="bg-primary">Update</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
