
<x-layouts.admin-layout>
    <x-slot name="title">Tambah Post</x-slot>
    <x-slot name="subtitle">Tambahkan post baru ke sistem.</x-slot>
    
    <div class="mx-auto">
        <form action="{{ route('admin::posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-8">
                @include('admin.posts._form')
            </div>
        </form>
    </div>
</x-layouts.admin-layout>