<div x-show="view === 'table'" x-transition class="mt-8 overflow-scroll rounded-4xl border border-zinc-200 bg-white shadow-sm">
    <table class="w-full">
        <thead class="bg-zinc-50 text-left text-sm text-zinc-500">
            <tr>
                @foreach (['Post', 'Category', 'Status', 'Published'] as $item)
                    <th class="px-6 py-4 font-medium">
                        {{ $item }}
                    </th>
                @endforeach
                @if (hasPermission('manage_post'))
                    <th class="px-6 py-4 font-medium">
                        Action
                    </th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $post)
                <tr x-show=" ('{{ strtolower($post->title) }}').includes(search.toLowerCase()) && (selectedCategory === '' || selectedCategory === '{{ $post->post_categories?->name }}') && (selectedStatus === '' || selectedStatus === '{{ $post->status }}') " x-transition class="border-t border-zinc-100">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin::posts.show', $post) }}" class="flex items-center gap-4">
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="h-16 w-20 rounded-2xl object-cover">

                            <div class="min-w-0">
                                <h3 class="truncate font-semibold text-zinc-900">
                                    {{ $post->title }}
                                </h3>

                                <p class="mt-1 line-clamp-1 text-sm text-zinc-500">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </div>
                        </a>
                    </td>

                    <td class="px-6 py-4">
                        <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-700">
                            {{ $post->post_categories?->name }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="rounded-full px-3 py-1 text-xs font-semibold capitalize
                            @if ($post->status === 'published') 
                                bg-emerald-100 text-emerald-700
                            @elseif ($post->status === 'draft')
                                bg-amber-100 text-amber-700
                            @else
                                bg-zinc-200 text-zinc-700 @endif
                            ">
                            {{ $post->status }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-sm text-zinc-600">
                        {{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}
                    </td>

                    @if (hasPermission('manage_post'))
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-start gap-2">
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
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>