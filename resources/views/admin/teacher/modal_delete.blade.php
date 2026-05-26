@if (hasPermission('manage_teacher'))
    <div x-show="openDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" @keydown.escape.window="openDelete = false">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="openDelete = false"></div>

        {{-- Modal Box --}}
        <div class="relative bg-white rounded-2xl shadow-xl p-8 w-full max-w-md mx-4 z-10">
            <div class="flex flex-col items-center text-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg">Hapus Data Guru</h3>
                    <p class="text-slate-400 text-sm mt-1">
                        Yakin ingin menghapus data <span class="font-bold text-slate-700" x-text="deleteName"></span>?
                        Tindakan ini tidak bisa dibatalkan.
                    </p>
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="button" @click="openDelete = false" class="flex-1 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-bold transition-colors">
                    Batal
                </button>
                <form :action="'{{ route('admin::teachers.destroy', ':id') }}'.replace(':id', deleteId)" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-bold transition-colors">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif