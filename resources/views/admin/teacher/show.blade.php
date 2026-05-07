<x-layouts.admin-layout>
    <x-slot name="title">Detail Guru</x-slot>
    <x-slot name="subtitle">Informasi lengkap data guru.</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin::teachers.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-teal-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar Guru
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- KOLOM KIRI - Foto & Identitas --}}
        <div class="flex flex-col gap-6">

            {{-- Card Foto --}}
            <div
                class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 flex flex-col items-center text-center gap-4">
                @if ($teacher->photo)
                <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}"
                    class="w-32 h-32 rounded-2xl object-cover border-2 border-slate-100">
                @else
                <div class="w-32 h-32 rounded-2xl bg-teal-100 flex items-center justify-center">
                    <span class="text-teal-600 font-extrabold text-4xl">{{ strtoupper(substr($teacher->name, 0, 1))
                        }}</span>
                </div>
                @endif

                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg">{{ $teacher->name }}</h3>
                    <p class="text-sm text-slate-400 mt-0.5">{{ $teacher->position }}</p>
                </div>

                @if ($teacher->active)
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                    Aktif
                </span>
                @else
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                    Non-Aktif
                </span>
                @endif

                {{-- Aksi --}}
                <div class="flex gap-2 w-full pt-2 border-t border-slate-100">
                    <a href="{{ route('admin::teachers.edit', $teacher) }}"
                        class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin::teachers.destroy', $teacher) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data {{ $teacher->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-sm font-bold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN - Detail Info --}}
        <div class="xl:col-span-2 flex flex-col gap-6">

            {{-- Data Pribadi --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="font-extrabold text-slate-900">Data Pribadi</h4>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">NIP</p>
                        <p class="font-bold text-slate-800 font-mono">{{ $teacher->nip }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Status Kepegawaian
                        </p>
                        <p class="font-bold text-slate-800">{{ $teacher->status }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Tempat Lahir</p>
                        <p class="font-bold text-slate-800">{{ $teacher->birth_place }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Tanggal Lahir</p>
                        <p class="font-bold text-slate-800">{{ $teacher->birth_date->format('d F Y') }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Golongan</p>
                        <p class="font-bold text-slate-800">{{ $teacher->group }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Jabatan</p>
                        <p class="font-bold text-slate-800">{{ $teacher->position }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Tanggal Bergabung
                        </p>
                        <p class="font-bold text-slate-800">{{ $teacher->join_date->format('d F Y') }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Masa Kerja</p>
                        @php
                        $years = (int) $teacher->join_date->diffInYears(now());
                        $months = (int) $teacher->join_date->copy()->addYears($years)->diffInMonths(now());
                        @endphp
                        <p class="font-bold text-slate-800">{{ $years }} tahun {{ $months }} bulan</p>
                    </div>

                </div>
            </div>

            {{-- Timestamps --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h4 class="font-extrabold text-slate-900">Riwayat Data</h4>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Dibuat</p>
                        <p class="font-bold text-slate-800">{{ $teacher->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wide mb-1">Terakhir Diperbarui
                        </p>
                        <p class="font-bold text-slate-800">{{ $teacher->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.admin-layout>