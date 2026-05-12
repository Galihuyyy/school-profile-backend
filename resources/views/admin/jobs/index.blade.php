
@php
    use \Carbon\Carbon;
@endphp

<x-layouts.admin-layout>
    <x-slot name="title">Data Lowongan</x-slot>
    <x-slot name="subtitle">Kelola seluruh data lowongan aktif dan non-aktif.</x-slot>

    @if (session('error'))
    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <span class="text-sm font-semibold">
            {{ session('error') }}
        </span>
    </div>
    @endif

    <div x-data="{ 
        search: '', 
        sort: '{{ $sort }}', 
        active: '{{ $active }}' 
    }">

        {{-- TOOLBAR --}}
        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div class="flex w-full items-center gap-2 sm:w-auto">

                {{-- Search --}}
                <div class="relative w-full sm:w-80">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                    </svg>

                    <input type="text"
                           x-model="search"
                           placeholder="Cari title atau company..."
                           class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-teal-500" />
                </div>

                {{-- Reset --}}
                <template x-if="search">
                    <button type="button"
                            @click="search = ''"
                            class="rounded-xl bg-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition-colors hover:bg-slate-300">
                        Reset
                    </button>
                </template>

                {{-- Sort --}}
                <select x-model="sort"
                        class="cursor-pointer rounded-xl bg-slate-200 px-3 py-2.5 text-sm font-semibold text-slate-600 focus:outline-none focus:ring-0">
                    <option value="latest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="az">A → Z</option>
                    <option value="za">Z → A</option>
                </select>

                {{-- Filter --}}
                <select x-model="active"
                        class="cursor-pointer rounded-xl bg-slate-200 px-3 py-2.5 text-sm font-semibold text-slate-600 focus:outline-none focus:ring-0">
                    <option value="">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                </select>
            </div>

            {{-- Tambah --}}
            @if (hasPermission('manage_job'))
            <a href="{{ route('admin::jobs.create') }}"
               class="flex items-center gap-2 whitespace-nowrap rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm transition-colors hover:bg-teal-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>

                Tambah Lowongan
            </a>
            @endif
        </div>

        {{-- TABLE --}}
        <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm"
             x-data="{ openDelete: false, deleteId: null, deleteTitle: '' }">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50">
                            @foreach (['No', 'Lowongan', 'Lokasi', 'Ketentuan', 'Masa Berlaku', 'Status', 'Aksi'] as $item)
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">
                                    {{ $item }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-50">
                        @forelse ($jobs as $job)
                        <tr
                            x-show="
                                !search ||
                                '{{ strtolower($job->title) }}'.includes(search.toLowerCase()) ||
                                '{{ strtolower($job->company_name) }}'.includes(search.toLowerCase())
                            "
                            class="transition-colors hover:bg-slate-50/50">

                            <td class="px-6 py-4 font-medium text-slate-400">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-bold leading-tight text-slate-800">
                                        {{ $job->title }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $job->company_name }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $job->location }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                                    {{ $job->job_requirements?->count() }} Ketentuan
                                </span>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ (int) Carbon::now()->diffInDays(Carbon::parse($job->expired_at)) + 1}} Hari Lagi - {{ Carbon::parse($job->expired_at)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($job->status)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
                                    Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    Non-Aktif
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('admin::jobs.show', $job) }}"
                                       class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition-colors hover:bg-blue-50 hover:text-blue-600">
                                        👁
                                    </a>

                                    @if (hasPermission('manage_job'))
                                        <a href="{{ route('admin::jobs.edit', $job) }}"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition-colors hover:bg-amber-50 hover:text-amber-600">
                                            ✏️
                                        </a>

                                        <button type="button"
                                                @click="openDelete = true; deleteRecord = {{ $job }}; deleteTitle = '{{ $job->title }}'"
                                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition-colors hover:bg-red-50 hover:text-red-600">
                                            🗑
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                                Data lowongan kosong.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- DELETE MODAL --}}
            <div x-show="openDelete"
                 x-cloak
                 class="fixed inset-0 z-50 flex items-center justify-center"
                 @keydown.escape.window="openDelete = false">

                {{-- Backdrop --}}
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
                     @click="openDelete = false"></div>

                @include('admin.jobs._modal-delete')
            </div>
        </div>
    </div>
</x-layouts.admin-layout>