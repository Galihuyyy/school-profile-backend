<x-layouts.html-starter>
    <section class="bg-white text-slate-900 pt-18">
        <nav class="max-w-6xl mx-auto px-6 py-10">
            <a href="{{ route('user::index') }}/#berita" class="inline-flex items-center gap-2 text-slate-500 hover:text-teal-600 transition-colors font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </nav>

        <header class="max-w-6xl mx-auto px-6 mb-12">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-teal-100 text-teal-700 text-xs font-bold uppercase tracking-widest rounded-md">Prestasi</span>
                <span class="text-slate-400 text-sm">{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                {{ $post->title  }}
            </h1>
            <div class="mt-8 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden border-2 border-teal-500">
                    <img src="https://ui-avatars.com/api/?name=Admin+Sekolah&background=0d9488&color=fff" alt="Author">
                </div>
                <div>
                    <p class="font-bold text-slate-800">Admin Sekolah</p>
                    <p class="text-sm text-slate-500">SMKN 1 SUKOREJO</p>
                </div>
            </div>
        </header>

        <div class="max-w-6xl mx-auto px-6 mb-16">
            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl">
                <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-125 object-cover" alt="{{ $post->title }}">
            </div>
        </div>

        <main class="max-w-5xl mx-auto px-6 mb-24">
            {!! $post->content !!}
        </main>

        <aside class="bg-slate-50 py-20">
            <div class="max-w-5xl mx-auto px-6">
                <h4 class="text-2xl font-bold mb-8">Berita Terbaru Lainnya</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($beritaTerkini as $berita)
                        <a href="{{ route('user::post.show', $berita->slug) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow cursor-pointer">
                            <p class="text-xs font-bold text-blue-600 mb-2 uppercase">{{ $berita->post_categories?->name }}</p>
                            <h5 class="text-lg font-bold hover:text-teal-600 transition-colors">{{ $berita->title }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

    </section>
</x-layouts.html-starter>