@extends('layouts.app')

@section('content')
    <main>
        <div class="contactus-container">
            <div class="contactus-title-container">
                <h3>Contact Us</h3>
            </div>
            <div class="contactus-form-container">
                <div class="user-datas">
                    <div class="user-data">
                        <label>Name</label>
                        <input type="text" class="contactus-input" />
                    </div>
                    <div class="user-data">
                        <label>Email</label>
                        <input type="email" class="contactus-input" />
                    </div>
                </div>

                <div class="message-container">
                    <label>Message</label>
                    <textarea cols="147" rows="10"></textarea>
                </div>

                <div class="contactus-button-container">
                    <button>Send</button>
                </div>
            </div>
        </div>
    </main>
@endsection
