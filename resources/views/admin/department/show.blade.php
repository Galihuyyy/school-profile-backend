<x-layouts.admin-layout>
    <x-slot name="title">Detail Jurusan</x-slot>
    <x-slot name="subtitle">Informasi lengkap data jurusan.</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin::departments.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Kembali ke Daftar Jurusan
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6" x-data="departmentPage()">
        <div class="flex flex-col gap-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 flex flex-col items-center text-center gap-4">

                @if ($department->image)
                    <img src="{{ Storage::url($department->image) }}" alt="{{ $department->name }}" class="w-full h-48 rounded-2xl object-cover border border-slate-100">
                @else
                    <div class="w-full h-48 rounded-2xl bg-teal-100 flex items-center justify-center">
                        <span class="text-teal-600 font-extrabold text-5xl">{{ strtoupper(substr($department->name, 0, 1)) }}</span>
                    </div>
                @endif

                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg">{{ $department->name }}</h3>
                </div>

                <div class="flex gap-2 w-full pt-2 border-t border-slate-100">
                    <a href="{{ route('admin::departments.edit', $department) }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <button type="button" @click="openDelete = true; deleteId = {{ $department->id }}; deleteName = '{{ $department->name }}'" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-sm font-bold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2 flex flex-col gap-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="font-extrabold text-slate-900">Informasi Jurusan</h4>
                </div>
                <div class="p-8 space-y-6">

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Nama Jurusan</p>
                        <p class="font-bold text-slate-800">{{ $department->name }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Deskripsi</p>
                        <p class="text-slate-700 leading-relaxed">{{ $department->description }}</p>
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="font-extrabold text-slate-900">Kepala Jurusan</h4>
                </div>
                <div class="p-8">
                    @if ($department->headTeacher)
                        <div class="flex items-center gap-5">
                            @if ($department->headTeacher->photo)
                                <img src="{{ Storage::url($department->headTeacher->photo) }}" alt="{{ $department->headTeacher->name }}" class="w-16 h-16 rounded-2xl object-cover border border-slate-100 shrink-0">
                            @else
                                <div class="w-16 h-16 rounded-2xl bg-teal-100 flex items-center justify-center shrink-0">
                                    <span class="text-teal-600 font-bold text-xl">{{ strtoupper(substr($department->headTeacher->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-extrabold text-slate-900">{{ $department->headTeacher->name }}</p>
                                <p class="text-sm text-slate-400 mt-0.5">{{ $department->headTeacher->position }}</p>
                                <p class="text-xs text-slate-400 mt-0.5 font-mono">{{ $department->headTeacher->nip }}</p>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ route('admin::teachers.show', $department->headTeacher) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-teal-50 hover:text-teal-600 text-slate-600 rounded-xl text-sm font-bold transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @else
                        <p class="text-slate-400 font-semibold text-sm">Belum ada kepala jurusan.</p>
                    @endif
                </div>
            </div>

            <div class="bg  rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="font-extrabold text-slate-900">Riwayat Data</h4>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Dibuat</p>
                        <p class="font-bold text-slate-800">{{ $department->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Terakhir Diperbarui</p>
                        <p class="font-bold text-slate-800">{{ $department->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

        </div>
        @include('admin.department.modal_delete')
        
        <x-slot name="scripts">
            @include('admin.department.script')
        </x-slot>
    </div>

    

</x-layouts.admin-layout>