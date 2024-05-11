@if (session()->all())
    <div class="session-message-container show-session-message">
        @if (session('success'))
            <div class="session-message-success bg-success">
                <span>{{ session('success') }}</span>
                <button id="closeSessionMessage"><i class="fas fa-x"></i></button>
            </div>
        @endif

        @if (session('error'))
            <div class="session-message-error bg-danger">
                <span>{{ session('error') }}</span>
                <button id="closeSessionMessage"><i class="fas fa-x"></i></button>
            </div>
        @endif
    </div>
@endif
