<div x-show="socmedModal.open" x-transition class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <form action="{{ route('admin::school-settings.socmed.update') }}" method="post" class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">
        @csrf
        <input type="hidden" name="key" x-model="socmedModal.key">

        <h3 class="text-lg font-bold mb-4">Atur <span class="capitalize" x-text="socmedModal.key.replace('_url', '')"></span></h3>

        <input 
            type="url"
            x-model="socmedModal.url"
            name="url"
            class="w-full p-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none"
            placeholder="Masukkan URL..."
        >

        <div class="flex justify-end gap-3 mt-6">
            <button @click="socmedModal.open=false" class="px-4 py-2 bg-slate-100 rounded-xl">
                Batal
            </button>

            <button type="submit" class="px-4 py-2 cursor-pointer bg-teal-600 text-white rounded-xl">
                Simpan
            </button>
        </div>

    </form>
</div>