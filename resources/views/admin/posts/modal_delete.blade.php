<div x-show="deleteModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4" style="display: none;">
    <div @click.away="closeDeleteModal()" x-transition class="w-full max-w-md rounded-4xl bg-white p-7 shadow-2xl">
        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-red-100 text-3xl">
            🗑️
        </div>
        <div class="mt-6">
            <h3 class="text-2xl font-bold text-zinc-900">
                Delete Post?
            </h3>
            <p class="mt-2 text-sm leading-6 text-zinc-500">
                Post
                <span class="font-semibold text-zinc-700" x-text="selectedPost?.title"></span>
                akan dihapus atau dipindahkan ke archive.
            </p>
        </div>

        <div class="mt-8 grid grid-cols-3 gap-3">
            <button @click="closeDeleteModal()" class="rounded-2xl border border-zinc-200 bg-white px-4 py-3 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100">
                Cancel
            </button>

            <button class="rounded-2xl bg-zinc-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-zinc-800">
                Archive
            </button>

            <button class="rounded-2xl bg-red-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-600">
                Delete
            </button>
        </div>
    </div>
</div>