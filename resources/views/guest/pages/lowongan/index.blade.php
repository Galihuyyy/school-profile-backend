<x-layouts.user-layout>
    <section class="relative overflow-hidden bg-gradient-to-br from-teal-600 via-teal-700 to-emerald-700">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-white rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-52 h-52 bg-white rounded-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 pb-20 pt-30">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-white text-sm font-semibold backdrop-blur">
                    ✨ Recruitment Open
                </span>

                <h1 class="mt-6 text-4xl md:text-5xl font-black leading-tight text-white">
                    Temukan Lowongan
                    <span class="text-teal-100">Terbaik Untukmu</span>
                </h1>

                <p class="mt-5 text-teal-50 text-lg leading-relaxed">
                    Jelajahi berbagai peluang karir terbaru dan temukan posisi yang sesuai dengan kemampuanmu.
                </p>

                <div class="mt-8 flex items-center gap-8 text-white">
                    <div>
                        <p class="text-3xl font-black">{{ $jobs->where('status', true)->count() }}</p>
                        <p class="text-sm text-teal-100">Lowongan Aktif</p>
                    </div>

                    <div class="w-px h-12 bg-white/20"></div>

                    <div>
                        <p class="text-3xl font-black">
                            {{ $jobs->where('expired_at', '>=', now())->count() }}
                        </p>
                        <p class="text-sm text-teal-100">Masih Dibuka</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-14">
        @if ($jobs->count())
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <div class="group bg-white rounded-3xl border border-slate-100 hover:border-teal-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="p-7">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                        Lowongan Aktif
                                    </div>

                                    <h2 class="mt-4 text-2xl font-black text-slate-800 leading-tight group-hover:text-teal-700 transition-colors">
                                        {{ $job->title }}
                                    </h2>

                                    <p class="mt-2 text-slate-500 font-medium">
                                        {{ $job->company_name }}
                                    </p>
                                </div>

                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-500 text-white flex items-center justify-center text-xl font-black shrink-0 shadow-lg shadow-teal-500/20">
                                    {{ strtoupper(substr($job->company_name, 0, 1)) }}
                                </div>
                            </div>

                            {{-- INFO --}}
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                        Lokasi
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-slate-700">
                                        {{ $job->location }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                        Deadline
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($job->expired_at)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- DESC --}}
                            <p class="mt-6 text-sm leading-relaxed text-slate-500 line-clamp-3">
                                {{ $job->description }}
                            </p>

                            {{-- REQUIREMENTS --}}
                            <div class="mt-6">
                                <h3 class="text-sm font-black text-slate-700 mb-3">
                                    Requirements
                                </h3>
                                @if ($job->job_requirements->count())
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($job->job_requirements->take(4) as $requirement)
                                            <span class="px-3 py-2 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold">
                                                {{ $requirement->requirement }}
                                            </span>
                                        @endforeach

                                        @if ($job->job_requirements->count() > 4)
                                            <span class="px-3 py-2 rounded-xl bg-teal-50 text-teal-700 text-xs font-bold">
                                                +{{ $job->job_requirements->count() - 4 }} lainnya
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="px-3 py-2 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold">
                                        Tidak Ada Ketentuan
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- FOOTER --}}
                        <div class="px-7 py-5 border-t border-slate-100 bg-slate-50/70 flex flex-wrap gap-y-3 items-center justify-between">
                            <div>
                                <p class="text-xs text-slate-400">
                                    Dipublish
                                </p>

                                <p class="text-sm font-bold text-slate-700">
                                    {{ $job->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <div class="w-full flex items-center justify-center gap-3">
                                <a href="{{ route('user::jobs.show', $job) }}" class="px-5 py-2.5 rounded-xl bg-white border border-slate-200 hover:border-teal-200 hover:text-teal-700 text-slate-700 text-sm font-bold transition-all">
                                    Detail
                                </a>

                                <a href="{{ $job->apply_link }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold transition-colors shadow-sm shadow-teal-600/20">
                                    Apply
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $jobs->links() }}
            </div>
        @else
            <div class="bg-white border border-slate-100 rounded-3xl p-16 text-center">
                <div class="w-20 h-20 rounded-3xl bg-slate-100 mx-auto flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-300"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.5"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9.75 9.75h4.5m-4.5 4.5h4.5M7.5 3.75h9A2.25 2.25 0 0118.75 6v12A2.25 2.25 0 0116.5 20.25h-9A2.25 2.25 0 015.25 18V6A2.25 2.25 0 017.5 3.75z"/>
                    </svg>
                </div>

                <h2 class="mt-6 text-2xl font-black text-slate-800">
                    Belum Ada Lowongan
                </h2>

                <p class="mt-2 text-slate-400">
                    Saat ini belum tersedia lowongan pekerjaan aktif.
                </p>
            </div>
        @endif
    </section>
</x-layouts.user-layout>