@extends('layouts.app')

@section('content')
    <main>
        <div class="login-page-section">
            <div class="login-left-side">
                <img src="images/logo/nav-logo.png" alt="Logo Left Side">
                <p>Car Rental Managemen System</p>
            </div>
            <form id="loginForm" style="width: 100%">
                <div class="login-right-side">

                    <div class="login-form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" id="email">
                        <div class="validation-error-container">
                            <p></p>
                        </div>
                    </div>

                    <div class="login-form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" id="password">
                        <div class="validation-error-container">
                            <p></p>
                        </div>
                    </div>

                    <div class="login-form-group">

                        {{-- <div class="remember-me-container">
                            <input type="checkbox" name="remember_me" id="remember-me">
                            <p>Remember me</p>
                        </div> --}}

                        <a href="{{ route('register') }}" id="register-link">Don't have an account? Register</a>

                        <a href="{{ route('forgotPassword') }}" id="forgot-password">Forgot Password?</a>

                    </div>

                    <div class="login-form-group">

                        <button type="button" onclick="handleLogin()"class="login-btn">Login</button>

                    </div>


                </div>
            </form>
        </div>
    </main>
@endsection
