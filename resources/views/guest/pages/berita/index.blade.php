<section class="py-20 bg-white" id="berita">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-extrabold mb-12 text-center">Berita Terkini</h2>
        <div class="grid grid-cols-2 {{ $posts->count() > 1 ? 'md:grid-cols-2' : '' }} gap-10">
            @foreach ($posts as $post)
                <a href="{{ route('user::post.show', $post->slug) }}">
                    <article class="mx-auto flex w-full max-w-2xl flex-col sm:flex-row gap-6 items-center group shadow-xl rounded-2xl">
                        <div class="w-full sm:w-48 h-48 rounded-3xl overflow-hidden shadow-lg">
                            <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="News">
                        </div>
                        <div class="flex-1 w-full max-sm:px-3">
                            <span class="text-teal-600 font-bold text-sm uppercase tracking-widest">{{ $post->post_categories->name }}</span>
                            <h3 class="text-2xl font-bold mt-2 mb-3 hover:text-teal-600 transition-colors cursor-pointer leading-tight">{{ $post->title }}</h3>
                            <p class="text-slate-600 line-clamp-2">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                            <p class="text-sm text-slate-400 mt-4 italic">{{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</p>
                        </div>
                    </article>
                </a>
            @endforeach
        </div>
    </div>
</section>