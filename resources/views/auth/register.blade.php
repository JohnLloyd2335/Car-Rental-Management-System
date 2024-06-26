@extends('layouts.app')

@section('content')
    <main>
        <div class="register-page-section">
            <div class="register-left-side">
                <img src="images/logo/nav-logo.png" alt="Logo Left Side">
                <p>Car Rental System</p>
            </div>
            <form method="POST" id="registerForm">
                @csrf
                <div class="register-right-side">
                    <div class="reg-form-group">
                        <label>Name</label>
                        <div class="icon-input-group @error('name') input-error @enderror">
                            <i class="fas fa-user"></i><input type="text" placeholder="Name" name="name" id="name"
                                value="{{ old('name') }}">
                        </div>
                        <p class="text-red"></p>
                    </div>

                    <div class="reg-form-group">
                        <label>Email</label>
                        <div class="icon-input-group @error('email') input-error @enderror">
                            <i class="fas fa-envelope"></i><input type="text" placeholder="Email" name="email"
                                id="email" value="{{ old('email') }}">
                        </div>
                        <p class="text-red"></p>
                    </div>

                    <div class="reg-form-group">
                        <label>Mobile Number</label>
                        <div class="icon-input-group @error('mobile_number') input-error @enderror">
                            <span>+63</span><input type="number" placeholder="Mobile Number" id="mobile_number"
                                name="mobile_number" value="{{ old('mobile_number') }}">
                        </div>
                        <p class="text-red"></p>
                    </div>

                    <div class="reg-form-group">
                        <label>Address</label>
                        <div class="icon-input-group @error('address') input-error @enderror">
                            <i class="fa-solid fa-location-dot"></i><input type="text" placeholder="Address"
                                name="address" id="address" value="{{ old('address') }}">
                        </div>
                        <p class="text-red"></p>
                    </div>

                    <div class="reg-form-group">
                        <label>Password</label>
                        <div class="icon-input-group @error('password') input-error @enderror">
                            <i class="fas fa-key"></i><input type="password" placeholder="Password" name="password"
                                id="password">
                        </div>
                        <p class="text-red"></p>
                    </div>

                    <div class="reg-form-group">
                        <label>Confirm Password</label>
                        <div class="icon-input-group @error('password_confirmation') input-error @enderror">
                            <i class="fas fa-key"></i><input type="password" placeholder="Confirm Password"
                                name="password_confirmation" id="password_confirmation">
                        </div>
                        <p class="text-red"></p>
                    </div>

                    <div class="reg-buttons">
                        <a href="{{ route('login') }}">Already have an account?</a>
                        <button type="button" id="registerButton" onclick="handleRegistration()">Register</button>
                    </div>

                </div>
            </form>

        </div>
    </main>
@endsection
