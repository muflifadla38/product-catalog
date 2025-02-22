@props(['id' => null, 'label', 'icon', 'route' => null, 'routeType'])

<li {{ $attributes->merge(['id' => $id]) }} @class([
    'nav-item mb-3',
    'active p-0' => request()->routeIs("$route.*"),
])>
    <a class="nav-link d-flex align-items-center" href="{{ $route ? route("$route.$routeType") : '#' }}">
        <img src='{{ asset("assets/images/$icon.png") }}' class="me-2" alt="{{ $icon }}">
        <span>{{ $label }}</span>
    </a>

    {{ $slot }}
</li>
