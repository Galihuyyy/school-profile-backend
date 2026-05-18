<x-layouts.admin-layout>
    <x-slot name="title">Posts & News</x-slot>
    <x-slot name="subtitle">Kelola berita, pengumuman, dan artikel sekolah.</x-slot>

        <div class="mx-auto max-w-7xl" x-data="postsPage()">
            @if (hasPermission('manage_post'))
                <div class="w-full flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-end">
                    <a href="{{ route('admin::posts.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-zinc-900 px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-zinc-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Post
                    </a>
                </div>
            @endif

            <div class="mt-8 rounded-4xl border border-zinc-200 bg-white p-4 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="relative max-w-xl flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-zinc-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5.25 5.25a7.5 7.5 0 0 0 11.4 11.4Z" />
                        </svg>

                        <input type="text" x-model.debounce.100ms="search" placeholder="Search post title..." class="h-12 w-full rounded-2xl border border-zinc-200 bg-zinc-50 pl-12 pr-4 text-sm focus:border-zinc-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-zinc-100">
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <select x-model="selectedCategory" class="h-12 rounded-2xl border border-zinc-200 bg-white px-4 text-sm focus:outline-none focus:ring-4 focus:ring-zinc-100">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <select x-model="selectedStatus" class="h-12 rounded-2xl border border-zinc-200 bg-white px-4 text-sm focus:outline-none focus:ring-4 focus:ring-zinc-100">
                            <option value="">All Status</option>
                            @foreach (['published', 'draft', 'archive'] as $item)
                                <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>

                        <div class="flex items-center gap-1 rounded-2xl bg-zinc-100 p-1">
                            <button @click="view='grid'" :class="view === 'grid' ? 'bg-white text-zinc-900 shadow-sm' : 'text-zinc-500'" class="rounded-xl px-4 py-2 text-sm font-medium transition">
                                Grid
                            </button>

                            <button @click="view='table'" :class="view === 'table' ? 'bg-white text-zinc-900 shadow-sm' : 'text-zinc-500'" class="rounded-xl px-4 py-2 text-sm font-medium transition">
                                Table
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.posts.datagrid.grid_view')
            @include('admin.posts.datagrid.table_view')
            
            @include('admin.posts.modal_delete')
        </div>

    <x-slot name="scripts">
        <script>
            function postsPage() {
                return {
                    view: 'grid',
                    search: '',
                    selectedCategory: '',
                    selectedStatus: '',
                    deleteModal: false,
                    selectedPost: null,

                    openDeleteModal(post) {
                        this.selectedPost = post
                        this.deleteModal = true
                    },

                    closeDeleteModal() {
                        this.deleteModal = false
                        this.selectedPost = null
                    }
                }
            }
        </script>
    </x-slot>
</x-layouts.admin-layout>
