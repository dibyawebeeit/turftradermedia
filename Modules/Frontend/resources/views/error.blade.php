<x-frontend::layouts.master :title="'Success'">
<style>
    .message {
        text-align: center;
    }
</style>
<div class="message">
    <h1>❌ Failed!</h1>
    @if (session()->has('error'))
      <p>{{ session('error') }}</p>
    @endif
    <a href="{{ url('/') }}">Try Again</a>
</div>
</x-frontend::layouts.master>