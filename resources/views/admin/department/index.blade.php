<x-layouts.admin-layout>
    <x-slot name="title">Data Jurusan</x-slot>
    <x-slot name="subtitle">Kelola seluruh data jurusan yang tersedia.</x-slot>

    <section x-data="departmentPage(@js($departments->items()))">
        {{-- TOOLBAR --}}
        <div class="flex max-xl:flex-col-reverse justify-between gap-4 mb-6">
            {{-- Search --}}
            <div class="flex items-center gap-2 w-full md:w-auto">
                <div class="relative w-full md:w-72">
                    <input type="text" x-model="search" placeholder="Cari jurusan..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200" >
                </div>
    
                <select x-model="sort" class="px-4 py-2.5 rounded-xl border border-slate-200">
                    <option value="asc">A → Z</option>
                    <option value="desc">Z → A</option>
                </select>
            </div>
    
            {{-- Tambah Jurusan --}}
            @if (hasPermission('manage_department'))
                <a href="{{ route('admin::departments.create') }}" class="w-fit self-end flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-xl text-sm font-bold transition-colors shadow-sm whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Jurusan
                </a>
            @endif
        </div>
    
        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
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
                        <template x-for="(department, index) in filteredDepartments" :key="department.id">
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-slate-400 font-medium">
                                    <span x-text="index + 1"></span>
                                </td>
    
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
    
                                        <template x-if="department.image">
                                            <img :src="'/storage/' + department.image" class="w-14 h-14 rounded-xl object-cover border border-slate-100 shrink-0" >
                                        </template>
    
                                        <div>
                                            <p class="font-bold text-slate-800" x-text="department.name"></p>
                                            <p class="text-xs text-slate-400 mt-0.5 line-clamp-1" x-text="department.description"> </p>
                                        </div>
                                    </div>
                                </td>
    
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
    
                                        <template x-if="department.head_teacher?.photo">
                                            <img :src="'/storage/' + department.head_teacher.photo" :alt="department.head_teacher.name" class="w-8 h-8 rounded-lg object-cover border border-slate-100 shrink-0" >
                                        </template>
    
                                        <template x-if="!department.head_teacher?.photo">
                                            <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center shrink-0">
                                                <span class="text-teal-600 font-bold text-xs" x-text="department.head_teacher?.name?.charAt(0)?.toUpperCase() ?? '?'" ></span>
                                            </div>
                                        </template>
    
                                        <p class="font-semibold text-slate-700" x-text="department.head_teacher?.name ?? '-'" ></p>
                                    </div>
                                </td>
    
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="`/admin/manage-departments/${department.id}`" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 text-slate-500 flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
    
                                        <a :href="`/admin/manage-departments/${department.id}/edit`" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-amber-50 hover:text-amber-600 text-slate-500 flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
    
                                        <button type="button" @click="openDelete = true; deleteId = department.id; deleteName = department.name" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-500 flex items-center justify-center transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredDepartments.length === 0">
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-semibold">Belum ada data jurusan.</p>
                                </div>
                            </td>
                        </tr>
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
            @include('admin.department.modal_delete')
    
        </div>
    </section>

    <x-slot name="scripts">
        @include('admin.department.script')
    </x-slot>

</x-layouts.admin-layout>