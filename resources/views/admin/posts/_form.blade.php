<div class="grid gap-8 lg:grid-cols-[1fr_360px]"x-data="thumbnailUploader()">
    <div class="space-y-6">
        <div class="rounded-4xl border border-zinc-200 bg-white p-8 shadow-sm">
            <div>
                <label class="text-sm font-semibold text-zinc-800">
                    Post Title
                </label>

                <input type="text" name="title" :disabled="readonly" value="{{ old('title', $post->title ?? '') }}" placeholder="Masukkan judul post..." class="mt-3 h-14 w-full rounded-2xl border border-zinc-200 px-5 text-lg font-semibold focus:border-zinc-900 focus:outline-none focus:ring-4 focus:ring-zinc-100">
            </div>
            <div class="mt-6">
                <label class="text-sm font-semibold text-zinc-800">
                    Slug
                </label>

                <div class="mt-3 flex overflow-hidden rounded-2xl border border-zinc-200">
                    <div class="flex items-center bg-zinc-100 px-4 text-sm text-zinc-500">
                        /posts/
                    </div>

                    <input type="text" name="slug" :disabled="readonly" value="{{ old('slug', $post->slug ?? '') }}" class="h-12 flex-1 px-4 focus:outline-none" placeholder="judul-post">
                </div>
            </div>
            <div class="mt-6">
                <label class="text-sm font-semibold text-zinc-800">
                    Content
                </label>

                <div class="mt-3 rounded-3xl border border-zinc-200 bg-zinc-50 p-4">
                    <textarea name="content" :disabled="readonly" rows="16" class="w-full resize-none bg-transparent text-sm leading-7 text-zinc-700 focus:outline-none" placeholder="Tulis isi post di sini...">{{ old('content', $post->content ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-4xl border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-zinc-900">
                        Thumbnail
                    </h3>
                    <p class="mt-1 text-sm text-zinc-500">
                        Upload gambar cover post.
                    </p>
                </div>

                <div class="rounded-2xl bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-500">
                    Optional
                </div>
            </div>

            <label class="mt-6 flex min-h-70 cursor-pointer flex-col items-center justify-center rounded-[28px] border-2 border-dashed border-zinc-200 bg-zinc-50 p-6 transition hover:border-zinc-400 hover:bg-zinc-100/50 {{ $mode == 'show' ? 'pointer-events-none' : '' }}" x-data="thumbnailUploader(
                '{{ isset($post) && $post->thumbnail
                    ? Storage::url($post->thumbnail)
                    : '' }}'
            )">
                <template x-if="!preview">
                    <div class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-white shadow-sm">
                            🖼️
                        </div>

                        <p class="mt-4 text-sm font-semibold text-zinc-800">
                            Upload Thumbnail
                        </p>

                        <p class="mt-1 text-xs text-zinc-500">
                            PNG, JPG up to 5MB
                        </p>
                    </div>
                </template>
                <template x-if="preview">
                    <div class="w-full">
                        <img :src="preview" class="max-h-72 w-full rounded-2xl object-cover shadow-lg">
                        <div class="mt-4 flex items-center justify-between rounded-2xl bg-white p-3 shadow-sm" x-show="!readonly">
                            <div>
                                <p class="text-sm font-semibold text-zinc-800">
                                    Thumbnail Preview
                                </p>

                                <p class="text-xs text-zinc-500">
                                    Klik area untuk mengganti gambar
                                </p>
                            </div>

                            <button type="button" @click.prevent="removePreview()" class="rounded-xl bg-red-100 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-200">
                                Remove
                            </button>
                        </div>
                    </div>
                </template>

                <input type="file" name="thumbnail" :disabled="readonly" accept="image/*" class="hidden" value="{{ old('thumbnail', $post->thumbnail ?? '') }}" @change="handlePreview($event)">
            </label>

        </div>

        <div class="rounded-4xl border border-zinc-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-900">
                Category
            </h3>

            <p class="mt-1 text-sm text-zinc-500">
                Pilih kategori untuk post ini.
            </p>

            <select name="category_id" :disabled="readonly" class="mt-5 h-12 w-full rounded-2xl border border-zinc-200 px-4 text-sm focus:outline-none focus:ring-4 focus:ring-zinc-100">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @include('admin.posts.action.form_action')
    </div>
</div>

@include('admin.posts.script')