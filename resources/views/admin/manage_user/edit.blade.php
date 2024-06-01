@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('manage_user.update', $user) }}" method="post" style="display: inline;">
        @csrf
        @method('PUT')
        <div class="main-content">
            <div class="user-container">

                <div class="page-title-container">
                    <h3>Edit User</h3>
                </div>

                <div class="edit-user-form-container">
                    <div class="user-form-row">
                        <div class="user-form-column">
                            <label>Name</label>
                            <input type="text" name="name" class="@error('name') input-error @enderror"
                                value="{{ $user->name }}">

                            @error('name')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="user-form-column">
                            <label>Email</label>
                            <input type="text" name="email" class="@error('email') input-error @enderror"
                                value="{{ $user->email }}">
                            @error('email')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="user-form-row">
                        <div class="user-form-column">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_number" class="@error('mobile_number') input-error @enderror"
                                value="{{ $user->mobile_number }}">
                            @error('mobile_number')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="user-form-column">
                            <label>Address</label>
                            <input type="text" name="address" class="@error('address') input-error @enderror"
                                value="{{ $user->address }}">
                            @error('address')
                                <div class="validation-error-container">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="user-form-row">
                        <div class="user-form-column">
                            <a class="bg-dark" href="{{ route('manage_user.index') }}">Cancel</a>
                            <button type="submit" class="bg-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
