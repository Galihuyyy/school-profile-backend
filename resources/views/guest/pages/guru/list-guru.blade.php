<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Guru - SMKN 1 ABCD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50">

    <header class="bg-white border-b border-slate-100 py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">Direktori Tenaga Pendidik</h1>
            <p class="text-xl text-slate-500 max-w-2xl mx-auto">Mengenal lebih dekat para inspirator di balik kesuksesan siswa-siswi SMKN 1 ABCD.</p>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-6 -mt-8">
        <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-slate-200/60 border border-slate-100 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-2">
                <button class="px-6 py-2.5 bg-teal-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-teal-600/20 transition-all">Semua Guru</button>
                <button class="px-6 py-2.5 bg-slate-50 text-slate-600 hover:bg-slate-100 rounded-xl font-bold text-sm transition-all">Normatif</button>
                <button class="px-6 py-2.5 bg-slate-50 text-slate-600 hover:bg-slate-100 rounded-xl font-bold text-sm transition-all">Produktif RPL</button>
                <button class="px-6 py-2.5 bg-slate-50 text-slate-600 hover:bg-slate-100 rounded-xl font-bold text-sm transition-all">Produktif DKV</button>
            </div>
            <div class="relative w-full md:w-80">
                <input type="text" placeholder="Cari nama guru..." class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:outline-none">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300 group">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Guru">
                    <div class="absolute bottom-4 left-4">
                        <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider text-teal-700 shadow-sm">Produktif</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-extrabold text-slate-900 text-lg mb-1">Anisa Rahma, S.T</h3>
                    <p class="text-sm text-slate-500 mb-4">Guru Kejuruan RPL</p>
                    <div class="flex gap-2">
                        <a href="#" class="p-2 bg-slate-50 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" class="p-2 bg-slate-50 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition-colors text-xs font-bold px-3">Lihat Profil</a>
                    </div>
                </div>
            </div>

            </div>
    </main>

    <footer class="py-12 border-t border-slate-200 text-center">
        <p class="text-slate-400 text-sm">© 2026 SMKN 1 ABCD. Membangun masa depan dengan inovasi.</p>
    </footer>

</body>
</html>