<div x-show="view === 'grid'" x-transition class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
    @foreach ($posts as $post)
        <div x-show="('{{ strtolower($post->title) }}').includes(search.toLowerCase()) && (selectedCategory === '' || selectedCategory === '{{ $post->post_categories?->name }}') && (selectedStatus === '' || selectedStatus === '{{ $post->status }}') " x-transition class="group overflow-hidden rounded-[28px] border border-zinc-200 bg-white shadow-sm transition hover:scale-[1.01] hover:shadow-xl">
            <a href="{{ route('admin::posts.show', $post) }}">
                <div class="relative overflow-hidden">
                    <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">

                    <div class="absolute left-4 top-4 flex items-center gap-2">
                        <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-zinc-900 backdrop-blur">
                            {{ $post->post_categories?->name }}
                        </span>

                        @if ($post->status === 'draft')
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Draft
                            </span>
                        @endif

                        @if ($post->status === 'archive')
                            <span class="rounded-full bg-zinc-900/90 px-3 py-1 text-xs font-semibold text-white backdrop-blur">
                                Archived
                            </span>
                        @endif

                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium text-zinc-500">
                            {{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}
                        </span>

                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold capitalize
                            @if ($post->status === 'published') 
                                bg-emerald-100 text-emerald-700
                            @elseif ($post->status === 'draft')
                                bg-amber-100 text-amber-700
                            @else
                                bg-zinc-200 text-zinc-700 @endif
                            ">
                            {{ $post->status }}
                        </span>
                    </div>

                    <h3 class="mt-4 line-clamp-2 text-lg font-bold leading-snug text-zinc-900">
                        {{ $post->title }}
                    </h3>

                    <p class="mt-3 line-clamp-3 text-sm leading-6 text-zinc-500">
                        {{ $post->content }}
                    </p>
                </div>
            </a>

            <div class="border-t border-zinc-100 px-5 py-4">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-zinc-200 font-semibold text-zinc-700">
                            {{ substr($post->created_by_name, 0, 1) }}
                        </div>

                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-zinc-800">
                                {{ $post->created_by_name }}
                            </p>
                            <p class="text-xs text-zinc-500">
                                Author
                            </p>
                        </div>
                    </div>

                    @if (hasPermission('manage_post'))
                        <div class="flex items-center gap-2">
                            @if ($post->status !== 'published')
                                <button type="button" class="inline-flex items-center gap-2 rounded-2xl bg-emerald-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Publish
                                </button>
                            @endif

                            <a href="{{ route('admin::posts.edit', $post) }}" class="rounded-2xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-zinc-800">
                                Edit
                            </a>

                            <button type="button" @click="openDeleteModal({ id: '{{ $post->id }}', title: '{{ addslashes($post->title) }}' })" class="flex h-10 w-10 items-center justify-center rounded-2xl bg-red-50 text-red-500 transition hover:bg-red-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21.75H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0A48.108 48.108 0 0 0 15.75 5.25m3.478.54a48.11 48.11 0 0 1-3.478-.54m0 0A48.094 48.094 0 0 0 12 5.25c-1.183 0-2.33.043-3.478.126m0 0A48.108 48.108 0 0 1 4.772 5.79" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>