<x-layouts.user-layout>

    <section class="bg-white text-slate-900 pt-18" x-data="{ search: '' }">
        <header class="bg-white border-b border-slate-100 py-20">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h1 class="text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">
                    Direktori Tenaga Pendidik
                </h1>

                <p class="text-xl text-slate-500 max-w-2xl mx-auto">
                    Mengenal lebih dekat para inspirator di balik kesuksesan siswa-siswi {{ schoolSetting('name') }}.
                </p>
            </div>
        </header>

        <section class="max-w-7xl mx-auto px-6 -mt-8">
            <div class="relative w-full">
                <input type="text" x-model="search" placeholder="Cari nama guru..." class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:outline-none">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                    </path>
                </svg>
            </div>
        </section>

        <main class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($teachers as $teacher)
                    <div x-show="'{{ strtolower($teacher->name) }}'.includes(search.toLowerCase())" x-transition class="bg-white rounded-4xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col" >
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" >

                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 rounded-xl bg-emerald-500 text-white text-[10px] font-bold uppercase tracking-wider shadow">
                                    {{ $teacher->active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <div class="absolute bottom-0 inset-x-0 p-5 bg-linear-to-t from-black/70 to-transparent">
                                <h3 class="text-white font-extrabold text-xl leading-tight">
                                    {{ $teacher->name }}
                                </h3>

                                <p class="text-white/80 text-sm mt-1">
                                    {{ $teacher->position }}
                                </p>
                            </div>
                        </div>

                        <div class="p-6 flex-1">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="w-full text-center col-span-2">
                                    <p class="text-xs text-slate-400">
                                        Status Kepegawaian
                                    </p>

                                    <p class="font-bold text-slate-800">
                                        {{ $teacher->status }}
                                    </p>
                                </div>

                                <div class="text-center max-sm:col-span-2">
                                    <p class="text-slate-400 text-xs mb-1">
                                        NIP
                                    </p>

                                    <p class="font-semibold text-slate-800">
                                        {{ $teacher->nip }}
                                    </p>
                                </div>

                                <div class="text-center max-sm:col-span-2">
                                    <p class="text-slate-400 text-xs mb-1">
                                        Golongan
                                    </p>

                                    <p class="font-semibold text-slate-800">
                                        {{ $teacher->group }}
                                    </p>
                                </div>

                                <div class="col-span-2 text-center">
                                    <p class="text-slate-400 text-xs mb-1">
                                        TTL
                                    </p>

                                    <p class="font-semibold text-slate-800">
                                        {{ $teacher->birth_place }},
                                        {{ $teacher->birth_date->format('d M Y') }}
                                    </p>
                                </div>

                                <div class="text-center col-span-2">
                                    <p class="text-slate-400 text-xs mb-1">
                                        Bergabung
                                    </p>

                                    <p class="font-semibold text-slate-800">
                                        {{ $teacher->join_date->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </section>
</x-layouts.user-layout>