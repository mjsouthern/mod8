@props(['type' => 'success', 'message'])

<div class="alert alert-{{ $type }} my-3" role="alert">
    {{ $message }}
</div>