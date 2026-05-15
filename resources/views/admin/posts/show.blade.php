
<x-layouts.admin-layout>
    <x-slot name="title">Detail Post</x-slot>
    <x-slot name="subtitle">Menampilkan Detail Post <b>{{ $post->title }}</b></x-slot>
    
    <div class="mx-auto">
        <form action="{{ route('admin::posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-8">
                @include('admin.posts._form')
            </div>
        </form>
    </div>
</x-layouts.admin-layout>