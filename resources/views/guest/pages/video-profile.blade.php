<section class="py-20 px-6 relative overflow-hidden" id="profil">
        <div class="max-w-5xl mx-auto text-center mb-12 relative z-10">
            <h2 class="text-4xl font-extrabold mb-4">Mengenal Lebih Dekat</h2>
            <p class="text-slate-600">Saksikan video profil untuk melihat fasilitas dan lingkungan belajar kami.</p>
        </div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="relative pt-[56.25%] rounded-[2.5rem] overflow-hidden shadow-2xl border-12 border-white ring-1 ring-slate-200">
                @if ($schoolSetting->profile_video_embed)
                    <iframe class="absolute top-0 left-0 w-full h-full"  src="{{ $schoolSetting->profile_video_embed }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen>
                    </iframe>
                @else
                    <div class="text-center text-slate-400">
                        Video belum tersedia
                    </div>
                @endif
            </div>
        </div>
    </section>