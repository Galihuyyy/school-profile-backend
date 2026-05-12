{{-- resources/views/guest/jobs/show.blade.php --}}
<x-layouts.user-layout>

    <section class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
        <div class="max-w-6xl mx-auto px-6 pb-22 pt-30">
            <a href="{{ route('user::jobs.index') }}"
               class="inline-flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                ← Kembali ke Lowongan
            </a>

            <div class="mt-8 flex flex-col lg:flex-row items-start justify-between gap-8">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-300 text-sm font-bold">
                        Lowongan Aktif
                    </div>

                    <h1 class="mt-5 text-4xl md:text-5xl font-black leading-tight text-white">
                        {{ $job->title }}
                    </h1>

                    <p class="mt-4 text-xl text-slate-300 font-medium">
                        {{ $job->company_name }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <div class="px-5 py-4 rounded-2xl bg-white/5 border border-white/10">
                            <p class="text-xs uppercase tracking-wider text-slate-400 font-bold">
                                Lokasi
                            </p>

                            <p class="mt-1 text-sm font-semibold text-white">
                                {{ $job->location }}
                            </p>
                        </div>

                        <div class="px-5 py-4 rounded-2xl bg-white/5 border border-white/10">
                            <p class="text-xs uppercase tracking-wider text-slate-400 font-bold">
                                Deadline
                            </p>

                            <p class="mt-1 text-sm font-semibold text-white">
                                {{ \Carbon\Carbon::parse($job->expired_at)->format('d M Y') }}
                            </p>
                        </div>

                        <div class="px-5 py-4 rounded-2xl bg-white/5 border border-white/10">
                            <p class="text-xs uppercase tracking-wider text-slate-400 font-bold">
                                Dipublish
                            </p>

                            <p class="mt-1 text-sm font-semibold text-white">
                                {{ $job->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-auto">
                    <a href="{{ $job->apply_link }}"
                       target="_blank"
                       class="w-full lg:w-auto inline-flex items-center justify-center gap-3 px-7 py-4 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white text-sm font-black shadow-xl shadow-teal-600/20 transition-colors">
                        Apply Sekarang
                        ↗
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- MAIN --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- DESCRIPTION --}}
                <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-sm">
                    <h2 class="text-2xl font-black text-slate-800">
                        Deskripsi Pekerjaan
                    </h2>

                    <div class="mt-5 prose prose-slate max-w-none">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                {{-- REQUIREMENTS --}}
                <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-sm">
                    <h2 class="text-2xl font-black text-slate-800">
                        Requirements
                    </h2>

                    @if ($job->job_requirements->count())
                        <div class="mt-6 space-y-4">
                            @foreach ($job->job_requirements as $requirement)
                                <div class="flex items-start gap-4 p-5 rounded-2xl bg-slate-50">
                                    <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 font-black text-sm flex items-center justify-center shrink-0">
                                        ✓
                                    </div>

                                    <p class="text-slate-700 leading-relaxed font-medium">
                                        {{ $requirement->requirement }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-6 rounded-2xl border border-dashed border-slate-200 p-10 text-center">
                            <p class="text-slate-400 font-medium">
                                Tidak ada requirement khusus untuk lowongan ini.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white border border-slate-100 rounded-3xl p-7 shadow-sm sticky top-24">
                    <h3 class="text-xl font-black text-slate-800">
                        Lamar Sekarang
                    </h3>

                    <p class="mt-2 text-sm leading-relaxed text-slate-500">
                        Klik tombol di bawah untuk melanjutkan proses apply lowongan.
                    </p>

                    <a href="{{ $job->apply_link }}"
                       target="_blank"
                       class="mt-6 w-full inline-flex items-center justify-center gap-3 px-5 py-4 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white text-sm font-black transition-colors shadow-sm shadow-teal-600/20">
                        Apply Lowongan
                        ↗
                    </a>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-400">
                                Status
                            </span>

                            <span class="px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold">
                                Aktif
                            </span>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-sm text-slate-400">
                                Expired
                            </span>

                            <span class="text-sm font-bold text-slate-700">
                                {{ \Carbon\Carbon::parse($job->expired_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layouts.user-layout>