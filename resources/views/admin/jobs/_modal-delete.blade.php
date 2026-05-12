<div class="relative z-10 mx-4 w-full max-w-md rounded-2xl bg-white p-8 shadow-xl">
    <div class="flex flex-col items-center gap-4 text-center">
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-red-50">
            <svg class="h-8 w-8 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>

        <div>
            <h3 class="text-lg font-extrabold text-slate-900">
                Hapus Lowongan
            </h3>

            <p class="mt-1 text-sm text-slate-400">
                Yakin ingin menghapus lowongan
                <span class="font-bold text-slate-700" x-text="deleteTitle"></span>?
            </p>
        </div>
    </div>

    <div class="mt-8 flex gap-3">
        <button type="button" @click="openDelete = false" class="flex-1 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-bold text-slate-600 transition-colors hover:bg-slate-200">
            Batal
        </button>

        <form action="{{ route('admin::jobs.destroy', ':data') }}.replace(':data', deleteRecord) }}" method="POST" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition-colors hover:bg-red-700">
                Ya, Hapus
            </button>
        </form>
    </div>
</div>