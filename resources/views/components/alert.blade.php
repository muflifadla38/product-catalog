@props(['type' => 'info', 'message'])

<div @class("alert alert-$type alert-dismissible fade show py-2 pe-0 d-flex justify-content-between align-items-center") role="alert">
    <span class="pe-4 text-start">
        <strong class="text-capitalize">{{ $type }}!</strong> {{ $message }}.
    </span>
    <button type="button" class="btn btn-close btn-sm py-1 position-relative shadow-none" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
