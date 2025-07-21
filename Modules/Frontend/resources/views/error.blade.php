<x-frontend::layouts.master :title="'Error'">
<div class="message-wrapper">
        <div class="message-box">
            <i class="fa fa-times-circle" aria-hidden="true"></i>
            <h1>Failed!</h1>
            @if (session()->has('error'))
                <p>{{ session('error') }}</p>
            @endif
            <a href="{{ url('/') }}">Try Again</a>
        </div>
    </div>
</x-frontend::layouts.master>