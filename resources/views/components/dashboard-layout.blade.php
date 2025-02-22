@props(['title' => null])

<x-main-layout>
    <div class="d-flex ">
        <x-sidebar />

        <div class="flex-grow-1 p-4">
            @if ($title)
                {{ $title }}
            @endif

            @if (session('message'))
                <div class="mb-4">
                    <x-alert message="{{ session('message') }}" />
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>
</x-main-layout>
