@extends('layouts.app')

@section('content')
    <main>
        <div class="profile-page-section">
            <div class="page-title-container">
                <h3>Profile</h3>
            </div>

            <div class="profile-container">
                <div class="profile-image-container">
                    <img src="https://placehold.co/600x400" alt="Profile Image">
                    <h3 style="text-align: center">{{ auth()->user()->name }}</h3>
                </div>
                <div class="profile-details-container">
                    <div class="profile-detail-row">
                        <div class="profile-detail-column">
                            <label>Name</label>
                            <div class="icon-input-group">
                                <i class="fas fa-user"></i><input type="text" placeholder="Name"
                                    value="{{ auth()->user()->name }}" disabled>
                            </div>
                        </div>
                        <div class="profile-detail-column">
                            <label>Email</label>
                            <div class="icon-input-group">
                                <i class="fas fa-envelope"></i><input type="email" placeholder="Email"
                                    value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="profile-detail-row">
                        <div class="profile-detail-column">
                            <label>Mobile Number</label>
                            <div class="icon-input-group">
                                <span>+63</span><input type="text" id="mobile_number" placeholder="Mobile Number"
                                    value="{{ auth()->user()->mobile_number }}" disabled>
                            </div>
                        </div>
                        <div class="profile-detail-column">
                            <label>Address</label>
                            <div class="icon-input-group">
                                <i class="fas fa-location-dot"></i><input type="text" placeholder="Address"
                                    value="{{ auth()->user()->address }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
