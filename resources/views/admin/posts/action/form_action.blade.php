@if ($mode == 'create')
    <div class="rounded-4xl border border-zinc-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-zinc-900">
            Publish
        </h3>

        <p class="mt-1 text-sm text-zinc-500">
            Simpan atau publish post sekarang.
        </p>

        <div class="mt-6 flex gap-3">
            <button type="submit" name="status" value="draft" class="flex-1 rounded-2xl border border-zinc-200 bg-white px-5 py-3 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100">
                Save Draft
            </button>

            <button type="submit" name="status" value="published" class="flex-1 rounded-2xl bg-zinc-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-zinc-800">
                Publish
            </button>
        </div>
    </div>
@endif

@if ($mode == 'edit')
    <div class="rounded-4xl border border-zinc-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-zinc-900">
            Simpat Perubahan
        </h3>

        <p class="mt-1 text-sm text-zinc-500">
            Simpan perubahan data post.
        </p>

        <div class="mt-6 flex gap-3">
            <a href="{{ back()->getTargetUrl() }}" name="status" value="draft" class="flex-1 rounded-2xl border border-zinc-200 bg-white px-5 py-3 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 text-center">
                Kembali
            </a>

            <button type="submit" class="flex-1 rounded-2xl bg-zinc-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-zinc-800 text-center">
                Simpan Perubahan
            </button>
        </div>
    </div>
@endif

@if ($mode == 'show')
    <div class="rounded-4xl border border-zinc-200 bg-white p-6 shadow-sm">
        <div class="flex gap-3">
            <a href="{{ route('admin::posts.index') }}" name="status" value="draft" class="flex-1 rounded-2xl border border-zinc-200 bg-white px-5 py-3 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 text-center">
                Kembali
            </a>

            @if(hasPermission('manage_post'))
                <a href="{{ route('admin::posts.edit', $post) }}" name="status" value="published" class="flex-1 rounded-2xl bg-zinc-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-zinc-800 text-center">
                    Edit Data
                </a>
            @endif
        </div>
    </div>
@endif