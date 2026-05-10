<div x-data="{
    preview: null,
    handlePhoto(event) {
        const file = event.target.files[0];
        if (!file) return;
        this.preview = URL.createObjectURL(file);
    }
}">

    {{-- FOTO --}}
    <div class="flex items-center gap-8 pb-8 mb-8 border-b border-slate-100">
        <div class="shrink-0">
            <div
                class="w-28 h-28 rounded-2xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 relative">
                {{-- Preview Alpine --}}
                <template x-if="preview">
                    <img :src="preview" class="w-full h-full object-cover">
                </template>

                {{-- Foto dari DB (edit mode) --}}
                <template x-if="!preview">
                    @if (isset($teacher) && $teacher->photo)
                    <img src="{{ Storage::url($teacher->photo) }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    @endif
                </template>
            </div>
        </div>

        <div>
            <p class="font-bold text-slate-700 mb-1">Foto Guru</p>
            <p class="text-xs text-slate-400 mb-3">Format JPG, PNG, WEBP. Maks. 2MB.</p>
            <label
                class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-teal-50 hover:text-teal-600 text-slate-600 text-sm font-semibold rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                Pilih Foto
                <input type="file" name="photo" accept="image/*" class="hidden" @change="handlePhoto">
            </label>
            @error('photo')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- FORM FIELDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Nama --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap <span
                    class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $teacher->name ?? '') }}"
                placeholder="Contoh: Budi Santoso, S.Pd" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
                {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('name')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- NIP --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">NIP <span class="text-red-500">*</span></label>
            <input type="text" name="nip" value="{{ old('nip', $teacher->nip ?? '') }}"
                placeholder="Nomor Induk Pegawai" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
                {{ $errors->has('nip') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('nip')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tempat Lahir --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir <span
                    class="text-red-500">*</span></label>
            <input type="text" name="birth_place" value="{{ old('birth_place', $teacher->birth_place ?? '') }}"
                placeholder="Contoh: Surabaya" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
            {{ $errors->has('birth_place') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('birth_place')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal Lahir --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir <span
                    class="text-red-500">*</span></label>
            <input type="date" name="birth_date"
                value="{{ old('birth_date', isset($teacher) ? $teacher->birth_date?->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
            {{ $errors->has('birth_date') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('birth_date')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jabatan --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Jabatan <span
                    class="text-red-500">*</span></label>
            <input type="text" name="position" value="{{ old('position', $teacher->position ?? '') }}"
                placeholder="Contoh: Guru Matematika" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
            {{ $errors->has('position') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('position')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Golongan --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Golongan <span class="text-red-500">*</span>
            </label>
            <select name="group" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
                {{ $errors->has('group') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">

                <option value="">-- Pilih Golongan --</option>

                @php
                    $golongan = [
                        'I' => ['A','B','C','D'],
                        'II' => ['A','B','C','D'],
                        'III' => ['A','B','C','D'],
                        'IV' => ['A','B','C','D','E'],
                        'IX' => [''],
                    ];
                @endphp

                @foreach ($golongan as $tingkat => $huruf)
                <optgroup label="Golongan {{ $tingkat }}">
                    @foreach ($huruf as $h)
                    @php 
                        $label = '/' . $h;
                        $value = $h != '' ? $tingkat . $label : $tingkat; 
                    @endphp
                    <option value="{{ $value }}" {{ old('group', $teacher->group ?? '') == $value ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                    @endforeach
                </optgroup>
                @endforeach

            </select>
            @error('group')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Status <span
                    class="text-red-500">*</span></label>
            <input type="text" name="status" value="{{ old('status', $teacher->status ?? '') }}"
                placeholder="Contoh: PNS / Honorer" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
            {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('status')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status Aktif --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-3">Keaktifan</label>
            <div class="flex items-center gap-6 py-3">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="radio" name="active" value="1" {{ old('active', $teacher->active ?? true) == 1 ?
                    'checked' : '' }}
                    class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                    <span
                        class="text-sm font-semibold text-slate-700 group-hover:text-teal-600 transition-colors">Aktif</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="radio" name="active" value="0" {{ old('active', $teacher->active ?? true) == 0 ?
                    'checked' : '' }}
                    class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">
                    <span
                        class="text-sm font-semibold text-slate-700 group-hover:text-teal-600 transition-colors">Non-Aktif</span>
                </label>
            </div>
        </div>

        {{-- Tanggal Bergabung --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Bergabung <span
                    class="text-red-500">*</span></label>
            <input type="date" name="join_date"
                value="{{ old('join_date', isset($teacher) ? $teacher->join_date?->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all
            {{ $errors->has('join_date') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">
            @error('join_date')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>