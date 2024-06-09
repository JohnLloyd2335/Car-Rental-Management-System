@extends('layouts.app')

@section('content')
    <main>
        <div class="forgot-password-page-section">
            <div class="forgot-password-left-side">
                <img src="images/logo/nav-logo.png" alt="Logo Left Side">
                <p>Car Rental System</p>
            </div>
            <form method="post" id="forgotPasswordForm">
                <div class="forgot-password-right-side">

                    <div class="forgot-password-form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" id="email">
                        <p class="text-red" id="validation-error-container" style="align-self: flex-start"></p>
                    </div>

                    <div class="forgot-password-form-group">
                        <button type="button" onclick="handleForgotPassword()" class="forgot-password-btn">Send Reset
                            Link</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
