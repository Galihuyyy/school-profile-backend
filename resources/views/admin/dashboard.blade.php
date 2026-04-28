<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Settings - Admin SMKN 1 ABCD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex">

    <x-admin.sidebar></x-admin.sidebar>

    <main class="ml-72 flex-1 p-12">
        <header class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900">School Settings</h2>
                <p class="text-slate-500 mt-1">Konfigurasi identitas utama sekolah Anda.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-bold text-slate-900">Administrator</p>
                    <p class="text-xs text-teal-600">Super Admin</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-100 border-2 border-teal-500"></div>
            </div>
        </header>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-10 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-xl text-slate-900">Informasi Umum</h3>
            </div>
            
            <form class="p-10 space-y-10">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-[2rem] bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden transition-all group-hover:border-teal-500 cursor-pointer">
                            <svg class="w-8 h-8 text-slate-400 group-hover:text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-teal-600 text-white p-2 rounded-lg shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-slate-800 mb-1">Logo Sekolah</h4>
                        <p class="text-sm text-slate-400">Gunakan format PNG atau JPG transparan (Maks. 2MB)</p>
                        <button type="button" class="mt-4 text-sm font-bold text-teal-600 hover:underline">Unggah Gambar Baru</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Nama Sekolah</label>
                        <input type="text" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all" value="SMKN 1 ABCD">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Akreditasi</label>
                        <select class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all appearance-none cursor-pointer">
                            <option value="A">A (Unggul)</option>
                            <option value="B">B (Baik)</option>
                            <option value="C">C (Cukup)</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-3">Deskripsi Singkat</label>
                        <textarea class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 h-32 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">Sekolah menengah kejuruan pusat keunggulan dengan fokus pada bidang teknologi informasi dan industri kreatif.</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-4">Status Sekolah</label>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="status" class="w-5 h-5 text-teal-600 focus:ring-teal-500 border-slate-300" checked>
                                <span class="text-slate-700 group-hover:text-teal-600 transition-colors">Negeri</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="status" class="w-5 h-5 text-teal-600 focus:ring-teal-500 border-slate-300">
                                <span class="text-slate-700 group-hover:text-teal-600 transition-colors">Swasta</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="pt-10 flex justify-end gap-4 border-t border-slate-100">
                    <button type="button" class="px-8 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-colors">Batalkan</button>
                    <button type="submit" class="px-8 py-3 bg-teal-600 text-white rounded-xl font-bold shadow-lg shadow-teal-600/20 hover:bg-teal-700 hover:-translate-y-1 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>