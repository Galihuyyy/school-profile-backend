
<x-layouts.admin-layout>
    <x-slot name="title">Update Post</x-slot>
    <x-slot name="subtitle">Update post {{ $post->title }}</x-slot>

    <div class="mx-auto ">
        <form action="{{ route('admin::posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-8">
                @include('admin.posts._form')
            </div>
        </form>
    </div>
</x-layouts.admin-layout>