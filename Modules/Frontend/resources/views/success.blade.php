<x-frontend::layouts.master :title="'Success'">
<div class="message-wrapper">
    <div class="message-box">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        <h1>Thank You!</h1>
        @if (session()->has('success'))
            <p>{{ session('success') }}</p>
        @endif
        <a href="{{ url('/') }}">Return to Home</a>
    </div>
</div>

</x-frontend::layouts.master>