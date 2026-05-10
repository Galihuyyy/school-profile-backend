<div x-data="{
    preview: null,
    handleImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        this.preview = URL.createObjectURL(file);
    }
}">

    {{-- GAMBAR --}}
    <div class="flex items-center gap-8 pb-8 mb-8 border-b border-slate-100">
        <div class="shrink-0">
            <div class="w-28 h-28 rounded-2xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 relative">
                {{-- Preview Alpine --}}
                <template x-if="preview">
                    <img :src="preview" class="w-full h-full object-cover">
                </template>

                {{-- Gambar dari DB (edit mode) --}}
                <template x-if="!preview">
                    @if (isset($department) && $department->image)
                        <img src="{{ Storage::url($department->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                        </div>
                    @endif
                </template>
            </div>
        </div>

        <div>
            <p class="font-bold text-slate-700 mb-1">Gambar Jurusan</p>
            <p class="text-xs text-slate-400 mb-3">Format JPG, PNG, WEBP. Maks. 2MB.</p>
            <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-teal-50 hover:text-teal-600 text-slate-600 text-sm font-semibold rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                </svg>
                Pilih Gambar
                <input type="file" name="image" accept="image/*" class="hidden" @change="handleImage">
            </label>
            @error('image')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- FORM FIELDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Nama Jurusan --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Jurusan <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $department->name ?? '') }}"
                placeholder="Contoh: Rekayasa Perangkat Lunak"
                class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
                    {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('name')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kepala Jurusan --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Kepala Jurusan <span class="text-red-500">*</span></label>
            <select name="head_teacher_id"
                class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all appearance-none cursor-pointer
                    {{ $errors->has('head_teacher_id') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
                <option value="">-- Pilih Guru --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ old('head_teacher_id', $department->head_teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
            @error('head_teacher_id')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" rows="4"
                placeholder="Tuliskan deskripsi singkat tentang jurusan ini..."
                class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all resize-none
                    {{ $errors->has('description') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">{{ old('description', $department->description ?? '') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

    </div>

</div>