
<div>

    <div class="pb-8 mb-8 border-b border-slate-100">
        <div class="flex items-start justify-between gap-6 flex-col lg:flex-row">
            <div>
                <h2 class="text-xl font-extrabold text-slate-800">
                    Informasi Lowongan
                </h2>

                <p class="text-sm text-slate-400 mt-1" x-show="!readonly">
                    Lengkapi seluruh data recruitment dan requirement pekerjaan.
                </p>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-3">
                    Status Lowongan
                </label>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="radio" x-model="form.status" :disabled="readonly" name="status" value="1" {{ old('status', $job->status ?? true) == 1 ? 'checked' : '' }} class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">

                        <span
                            class="text-sm font-semibold text-slate-700 group-hover:text-teal-600 transition-colors">
                            Aktif
                        </span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="radio" x-model="form.status" :disabled="readonly" name="status" value="0" {{ old('status', $job->status ?? true) == 0 ? 'checked' : '' }} class="w-4 h-4 text-teal-600 border-slate-300 focus:ring-teal-500">

                        <span
                            class="text-sm font-semibold text-slate-700 group-hover:text-teal-600 transition-colors">
                            Non-Aktif
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Nama Perusahaan <span class="text-red-500">*</span>
            </label>

            <input type="text" x-model="form.company_name" :disabled="readonly" name="company_name" placeholder="Contoh: PT Digital Nusantara" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all {{ $errors->has('company_name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">

            @error('company_name')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Posisi Dibutuhkan <span class="text-red-500">*</span>
            </label>

            <input type="text" x-model="form.title" :disabled="readonly" name="title" placeholder="Contoh: Frontend Developer" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all {{ $errors->has('title') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">

            @error('title')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Lokasi <span class="text-red-500">*</span>
            </label>

            <input type="text" x-model="form.location" :disabled="readonly" name="location" placeholder="Contoh: Surabaya, Indonesia" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all {{ $errors->has('location') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">

            @error('location')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Apply Link <span class="text-red-500">*</span>
            </label>

            <input type="url" x-model="form.apply_link" :disabled="readonly" name="apply_link" placeholder="https://example.com/apply" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all {{ $errors->has('apply_link') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">

            @error('apply_link')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Tanggal Expired <span class="text-red-500">*</span>
            </label>

            <input type="date" x-model="form.expired_at" :disabled="readonly" name="expired_at" class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all {{ $errors->has('expired_at') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}">

            @error('expired_at')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="mt-6">
        <label class="block text-sm font-bold text-slate-700 mb-2">
            Deskripsi Pekerjaan <span class="text-red-500">*</span>
        </label>

        <textarea x-model="form.description" :disabled="readonly" name="description" rows="6" placeholder="Jelaskan deskripsi pekerjaan..." class="w-full px-4 py-3 rounded-xl border text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all resize-none {{ $errors->has('description') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50' }}"></textarea>

        @error('description')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-8 border-t border-slate-100 pt-8">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-lg font-extrabold text-slate-800">
                    Requirements <small>(opsional)</small>
                </h3>

                <p class="text-sm text-slate-400 mt-1" x-show="!readonly">
                    Tambahkan syarat atau ketentuan recruitment.
                </p>
            </div>

            <button x-show="!readonly" type="button" @click="addRequirement()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Tambah Requirement
            </button>
        </div>

        <div class="space-y-4">
            @if (isset($job) && $job->job_requirements()->count() === 0)
                <div
                    x-transition
                    class="border border-dashed border-slate-200 rounded-2xl p-8 bg-slate-50/70"
                >
                    <div class="flex flex-col items-center justify-center text-center">

                        <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                            </svg>
                        </div>

                        <h4 class="text-sm font-bold text-slate-700">
                            Tidak ada ketentuan
                        </h4>

                        <p class="text-xs text-slate-400 mt-1 max-w-sm">
                            Recruitment ini tidak memiliki requirement atau syarat tambahan.
                        </p>

                        <button
                            x-show="!readonly"
                            type="button"
                            @click="addRequirement()"
                            class="mt-5 inline-flex items-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors"
                        >
                            <svg class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4" />
                            </svg>

                            Tambah Requirement
                        </button>
                    </div>
                </div>
            @endif
            <template x-for="(requirement, index) in form.requirements" :key="index">
                <div class="flex items-start gap-3">

                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 shrink-0">
                        <span x-text="index + 1"></span>
                    </div>

                    <div class="flex-1">
                        <input type="text" :name="`form.requirements[${index}]`" x-model="form.requirements[index]" :disabled="readonly" placeholder="Contoh: Minimal pengalaman 1 tahun" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all">
                    </div>

                    <button type="button"
                            @click="removeRequirement(index)"
                            x-show="form.requirements.length > 1 && !readonly"
                            class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center transition-colors shrink-0">
                        ✕
                    </button>
                </div>
            </template>
            <p
                x-show="requirementError"
                x-text="requirementError"
                class="text-red-500 text-xs mt-2"
            ></p>

            @error('form.requirements')
            <p class="text-red-500 text-xs">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>
</div>

@include('admin.jobs.scripts')


