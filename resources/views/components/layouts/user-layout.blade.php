<x-layouts.html-starter>
    <x-slot name="styles">
        {{ $styles ?? '' }}
    </x-slot>
    
    <x-navbar></x-navbar>
    {{ $slot }}
    <x-footer></x-footer>

    <x-slot name="scripts">
        {{ $scripts ?? ''}}
    </x-slot>
</x-layouts.html-starter>