<x-layouts.html-starter>
    <x-slot name="styles">
        {{ $styles ?? '' }}
    </x-slot>
    
    <x-admin.sidebar></x-admin.sidebar>
    <main class="ml-72 flex-1 p-12">
        @if ($hiddenHeader !== true)
            <x-admin.page-header>
                <x-slot name="title">{{ $title ?? '' }}</x-slot>
                <x-slot name="subtitle">{{ $subtitle ?? '' }}</x-slot>
            </x-admin.page-header>
        @endif
        <x-admin.notif></x-admin.notif>
        {{ $slot }}
    </main>

    <x-slot name="scripts">
        {{ $scripts ?? ''}}
    </x-slot>
</x-layouts.html-starter>