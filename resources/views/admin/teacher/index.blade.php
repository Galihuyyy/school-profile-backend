<x-layouts.admin-layout>
    <x-slot name="title">Data Guru</x-slot>
    <x-slot name="subtitle">Kelola seluruh data guru aktif dan non-aktif.</x-slot>

    @if (session('error'))
    <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
    @endif

    {{-- TOOLBAR --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        {{-- Search --}}
        <form method="GET" action="{{ route('admin::teachers.index') }}"
            class="flex items-center gap-2 w-full sm:w-auto">
            <div class="relative w-full sm:w-72">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIP..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
            </div>
            <button type="submit"
                class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-600 rounded-xl text-sm font-semibold transition-colors">
                Cari
            </button>
            @if (request('search'))
            <a href="{{ route('admin::teachers.index') }}"
                class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-600 rounded-xl text-sm font-semibold transition-colors">
                Reset
            </a>
            @endif
        </form>

        {{-- Tambah Guru --}}
        <a href="{{ route('admin::teachers.create') }}"
            class="flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors shadow-sm whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Guru
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden"
        x-data="{ openDelete: false, deleteId: null, deleteName: '' }">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-10">#
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Guru
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">NIP
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">
                            Jabatan</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Status
                        </th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($teachers as $teacher)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- No --}}
                        <td class="px-6 py-4 text-slate-400 font-medium">
                            {{ $teachers->firstItem() + $loop->index }}
                        </td>

                        {{-- Nama + Foto --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if ($teacher->photo)
                                <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}"
                                    class="w-14 h-14 rounded-xl object-cover shrink-0 border border-slate-100">
                                @else
                                <div class="w-14 h-14 rounded-xl bg-teal-100 flex items-center justify-center shrink-0">
                                    <span class="text-teal-600 font-bold text-sm">{{ strtoupper(substr($teacher->name,
                                        0, 1)) }}</span>
                                </div>
                                @endif
                                <div>
                                    <p class="font-bold text-slate-800 leading-tight">{{ $teacher->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $teacher->birth_place }}, {{
                                        $teacher->birth_date->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- NIP --}}
                        <td class="px-6 py-4 text-slate-600 font-mono text-xs">
                            {{ $teacher->nip }}
                        </td>

                        {{-- Jabatan --}}
                        <td class="px-6 py-4 text-slate-600">{{ $teacher->position }}</td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
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
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin::teachers.show', $teacher) }}"
                                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 text-slate-500 flex items-center justify-center transition-colors"
                                    title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a href="{{ route('admin::teachers.edit', $teacher) }}"
                                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-500 flex items-center justify-center transition-colors"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <button type="button"
                                    @click="openDelete = true; deleteId = {{ $teacher->id }}; deleteName = '{{ $teacher->name }}'"
                                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-500 flex items-center justify-center transition-colors"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m0 0a4 4 0 108 0 4 4 0 01-8 0z" />
                                    </svg>
                                </div>
                                <p class="text-slate-400 font-semibold">Belum ada data guru.</p>
                                <a href="{{ route('admin::teachers.create') }}"
                                    class="text-teal-600 text-sm font-bold hover:underline">
                                    Tambah guru pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Modal Konfirmasi Hapus --}}
        <div x-show="openDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center"
            @keydown.escape.window="openDelete = false">

            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="openDelete = false"></div>

            {{-- Modal Box --}}
            <div class="relative bg-white rounded-2xl shadow-xl p-8 w-full max-w-md mx-4 z-10">
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-lg">Hapus Data Guru</h3>
                        <p class="text-slate-400 text-sm mt-1">
                            Yakin ingin menghapus data <span class="font-bold text-slate-700"
                                x-text="deleteName"></span>?
                            Tindakan ini tidak bisa dibatalkan.
                        </p>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="button" @click="openDelete = false"
                        class="flex-1 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-bold transition-colors">
                        Batal
                    </button>
                    <form :action="`/admin/teachers/${deleteId}`" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-bold transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if ($teachers->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
            <p class="text-sm text-slate-400">
                Menampilkan {{ $teachers->firstItem() }}–{{ $teachers->lastItem() }} dari {{ $teachers->total() }} guru
            </p>
            {{ $teachers->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

</x-layouts.admin-layout>