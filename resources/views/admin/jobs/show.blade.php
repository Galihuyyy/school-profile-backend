<x-layouts.admin-layout>
    <x-slot name="title">Detail Lowongan</x-slot>
    <x-slot name="subtitle">Menampilkan Detail Lowongan <b>{{ $job->company_name }} - {{ $job->company_name }}</b></x-slot>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm" x-data="jobForm()" x-init="init()" x-cloak>
        <div class="p-8 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin::jobs.index') }}"
                    class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h3 class="font-extrabold text-slate-900">Form Tambah Lowongan</h3>
                    <p class="text-xs text-slate-400">Isi semua field yang wajib diisi</p>
                </div>
            </div>
        </div>
        <form action="{{ route('admin::jobs.store') }}" method="POST" class="p-8">
            @csrf

            @include('admin.jobs._form')

            <div class="flex items-center justify-end gap-3 mt-8 pt-8 border-t border-slate-100">
                <a href="{{ route('admin::jobs.index') }}"
                    class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-bold transition-colors">
                    Kembali
                </a>
                <a href="{{ route('admin::jobs.edit', $job) }}"
                    class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold shadow-sm shadow-teal-600/20 transition-colors">
                    Edit Data
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin-layout>