@extends('layouts.app')

@section('content')
    <main>
        <div class="change-password-page-section">
            <div class="change-password-left-side">
                <p>Car Rental Managemen System</p>
            </div>
            <form id="passwordResetForm" method="post">
                <div class="change-password-right-side">

                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="token" id="token" value="{{ $token }}">

                    <div class="change-password-form-group">
                        <label>New Password</label>
                        <input type="password" name="password" id="password" placeholder="New Password">
                        <p class="text-red" style="align-self: flex-start"></p>
                    </div>

                    <div class="change-password-form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Password Confirmation">
                        <p class="text-red"></p>
                    </div>

                    <div class="change-password-form-group">
                        <button type="button" id="reset-button" onclick="resetPassword()">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
