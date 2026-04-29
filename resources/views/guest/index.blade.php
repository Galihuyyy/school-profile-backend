<x-layouts.user-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/guest/hero-section.css') }}">
    </x-slot>
    @include('guest.pages.hero-section')
    @include('guest.pages.video-profile')
    @include('guest.pages.jurusan')
    @include('guest.pages.guru.index')
    @include('guest.pages.berita.index')
    @include('guest.pages.kontak')
</x-layouts.user-layout>