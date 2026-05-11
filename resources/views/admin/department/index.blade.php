<x-layouts.admin-layout>
    <x-slot name="title">Data Jurusan</x-slot>
    <x-slot name="subtitle">Kelola seluruh data jurusan yang tersedia.</x-slot>

    {{-- TOOLBAR --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        {{-- Search --}}
        <form method="GET" action="{{ route('admin::departments.index') }}"
            class="flex items-center gap-2 w-full sm:w-auto">
            <div class="relative w-full sm:w-72">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari jurusan atau kepala jurusan..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" />
            </div>
            <button type="submit"
                class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-600 rounded-xl text-sm font-semibold transition-colors">
                Cari
            </button>
            @if (request('search'))
                <a href="{{ route('admin::departments.index') }}"
                    class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-500 rounded-xl text-sm font-semibold transition-colors">
                    Reset
                </a>
            @endif
        </form>

        {{-- Tambah Jurusan --}}
        @if (hasPermission('manage_department'))
            <a href="{{ route('admin::departments.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Jurusan
            </a>
        @endif
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden"
        x-data="{ openDelete: false, deleteId: null, deleteName: '' }">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-10">#</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Jurusan</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Kepala Jurusan</th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($departments as $department)
                        <tr class="hover:bg-slate-50/50 transition-colors">

                            {{-- No --}}
                            <td class="px-6 py-4 text-slate-400 font-medium">
                                {{ $departments->firstItem() + $loop->index }}
                            </td>

                            {{-- Gambar + Nama --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($department->image)
                                        <img src="{{ Storage::url($department->image) }}"
                                            alt="{{ $department->name }}"
                                            class="w-14 h-14 rounded-xl object-cover border border-slate-100 shrink-0">
                                    @else
                                        <div
                                            class="w-14 h-14 rounded-xl bg-teal-100 flex items-center justify-center shrink-0">
                                            <span
                                                class="text-teal-600 font-bold text-lg">{{ strtoupper(substr($department->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $department->name }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ $department->description }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Kepala Jurusan --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($department->headTeacher?->photo)
                                        <img src="{{ Storage::url($department->headTeacher->photo) }}"
                                            alt="{{ $department->headTeacher->name }}"
                                            class="w-8 h-8 rounded-lg object-cover border border-slate-100 shrink-0">
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center shrink-0">
                                            <span
                                                class="text-teal-600 font-bold text-xs">{{ strtoupper(substr($department->headTeacher?->name ?? '?', 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <p class="font-semibold text-slate-700">{{ $department->headTeacher?->name ?? '-' }}</p>
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin::departments.show', $department) }}"
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

                                    <a href="{{ route('admin::departments.edit', $department) }}"
                                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-500 flex items-center justify-center transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <button type="button"
                                        @click="openDelete = true; deleteId = {{ $department->id }}; deleteName = '{{ $department->name }}'"
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
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-semibold">Belum ada data jurusan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($departments->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                <p class="text-sm text-slate-400">
                    Menampilkan {{ $departments->firstItem() }}–{{ $departments->lastItem() }} dari
                    {{ $departments->total() }} jurusan
                </p>
                {{ $departments->appends(request()->query())->links() }}
            </div>
        @endif

        {{-- Modal Konfirmasi Hapus --}}
        <div x-show="openDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center"
            @keydown.escape.window="openDelete = false">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="openDelete = false"></div>
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
                        <h3 class="font-extrabold text-slate-900 text-lg">Hapus Data Jurusan</h3>
                        <p class="text-slate-400 text-sm mt-1">
                            Yakin ingin menghapus jurusan <span class="font-bold text-slate-700"
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
                    <form :action="`/admin/manage-departments/${deleteId}`" method="POST" class="flex-1">
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

    </div>

</x-layouts.admin-layout>