@extends('layouts.app')

@section('content')
    <main>
        <div class="profile-page-section">
            <div class="page-title-container">
                <h3>Account Settings</h3>
            </div>

            @include('includes.session-messages')

            <form action="{{ route('account_settings.update', auth()->user()->id) }}" method="post">
                @csrf
                @method('PUT')


                <div class="profile-container">
                    <div class="profile-image-container">
                        <img src="https://placehold.co/600x400" alt="Profile Image">
                        <h3 style="text-align: center">{{ auth()->user()->name }}</h3>
                    </div>
                    <div class="profile-details-container">
                        <form action="">
                            <div class="profile-detail-row">
                                <div class="profile-detail-column">
                                    <label>Name</label>
                                    <div class="icon-input-group">
                                        <i class="fas fa-user"></i><input type="text" id="name" placeholder="Name"
                                            value="{{ auth()->user()->name }}" disabled name="name">
                                    </div>
                                    @error('name')
                                        <div class="validation-error-container">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="profile-detail-column">
                                    <label>Email</label>
                                    <div class="icon-input-group">
                                        <i class="fas fa-envelope"></i><input type="email" id="email"
                                            placeholder="Email" value="{{ auth()->user()->email }}" disabled name="email">
                                    </div>

                                    @error('email')
                                        <div class="validation-error-container">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="profile-detail-row">

                                <div class="profile-detail-column">
                                    <label>Mobile Number</label>
                                    <div class="icon-input-group">
                                        <span>+63</span><input type="text" id="mobile_number" id="password"
                                            placeholder="Mobile Number" value="{{ auth()->user()->mobile_number }}" disabled
                                            name="mobile_number">
                                    </div>


                                    @error('mobile_number')
                                        <div class="validation-error-container">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="profile-detail-column">
                                    <label>Address</label>
                                    <div class="icon-input-group">
                                        <i class="fas fa-location-dot"></i><input name="address" type="text"
                                            placeholder="Address" value="{{ auth()->user()->address }}" id="address"
                                            disabled>
                                    </div>


                                    @error('address')
                                        <div class="validation-error-container">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="profile-detail-row" id="passwordRow">
                                <div class="profile-detail-column">
                                    <label>Password</label>
                                    <div class="icon-input-group">
                                        <i class="fas fa-key"></i><input type="password" placeholder="Password" disabled
                                            id="password" name="password">
                                    </div>

                                    @error('password')
                                        <div class="validation-error-container">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                                <div class="profile-detail-column">
                                    <label>Confirm Password</label>
                                    <div class="icon-input-group">
                                        <i class="fas fa-key"></i><input type="password" placeholder="Confirm Password"
                                            disabled id="confirmPassword" name="password_confirmation">
                                    </div>


                                    @error('password_confirmation')
                                        <div class="validation-error-container">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="profile-detail-row">
                                <div class="profile-detail-column">
                                    <button id="cancelProfileEditButton" type="button" onclick="cancelEditProfile()"
                                        class="bg-dark">Cancel</button>
                                    <button id="editProfileButton" type="button" onclick="showAccountSettingsInput()"
                                        class="bg-primary">Edit</button>

                                    <button id="updateProfileButton" type="submit" class="bg-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </form>

        </div>
    </main>
@endsection
