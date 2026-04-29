<section class="py-24 relative" id="kontak">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-6">Hubungi Kami</h2>
                <p class="text-lg text-slate-600 mb-10 leading-relaxed">
                    Punya pertanyaan mengenai pendaftaran atau fasilitas? Tim kami siap membantu Anda memberikan informasi yang dibutuhkan.
                </p>
                
                <div class="space-y-8">
                    <div class="flex items-center gap-5 group">
                        <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center border border-teal-100 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Lokasi</p>
                            <p class="text-lg font-bold text-slate-800">{{ $schoolSetting->location }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-5 group">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Email Resmi</p>
                            <p class="text-lg font-bold text-slate-800">{{ $schoolSetting->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 p-10 rounded-[2.5rem] border border-slate-200 shadow-xl shadow-slate-200/50 relative">
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-teal-100 rounded-full blur-2xl opacity-60"></div>
                
                <form class="space-y-5 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <input type="text" placeholder="Nama" class="w-full p-4 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none transition-all">
                        <input type="email" placeholder="Email" class="w-full p-4 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none transition-all">
                    </div>
                    <input type="text" placeholder="Subjek" class="w-full p-4 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:outline-none transition-all">
                    <textarea placeholder="Pesan Anda" class="w-full p-4 rounded-xl bg-white border border-slate-200 h-32 focus:ring-2 focus:ring-teal-500 focus:outline-none transition-all"></textarea>
                    <button class="w-full py-4 bg-teal-600 text-white font-bold rounded-xl shadow-lg shadow-teal-600/20 hover:bg-teal-700 hover:-translate-y-1 transition-all duration-300">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>