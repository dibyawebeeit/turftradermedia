<x-frontend::layouts.master :title="'Success'">
<style>
    .message {
        text-align: center;
    }
</style>
<div class="message">
    <h1>🎉 Thank You!</h1>
    @if (session()->has('success'))
      <p>{{ session('success') }}</p>
    @endif
    <a href="{{ url('/') }}">Return to Home</a>
</div>
</x-frontend::layouts.master>