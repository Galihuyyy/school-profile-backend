<x-layouts.html-starter>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/guest/hero-section.css') }}">
    </x-slot>
    @include('guest.pages.hero-section')
    @include('guest.pages.video-profile')
    @include('guest.pages.jurusan')
    @include('guest.pages.berita')
    @include('guest.pages.kontak')
</x-layouts.html-starter>