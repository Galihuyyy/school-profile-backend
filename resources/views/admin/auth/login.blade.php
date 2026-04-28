<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SMKN 1 ABCD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 font-['Inter'] min-h-screen flex items-center justify-center p-6">
    
    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 p-10 border border-slate-100">
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-teal-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-teal-600/30">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900">Admin Portal</h1>
            <p class="text-slate-500 mt-2">Silakan masuk untuk mengelola data sekolah</p>
        </div>

        <form class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Email / Username</label>
                <input type="text" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white focus:outline-none transition-all" placeholder="admin@smkn1abcd.sch.id">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white focus:outline-none transition-all" placeholder="••••••••">
            </div>
            <button class="w-full py-4 bg-teal-600 text-white font-bold rounded-2xl shadow-lg shadow-teal-600/30 hover:bg-teal-700 hover:-translate-y-1 transition-all duration-300">
                Masuk ke Dashboard
            </button>
        </form>
        
        <p class="text-center mt-8 text-sm text-slate-400">
            &copy; 2026 Management System SMKN 1 ABCD
        </p>
    </div>

</body>
</html>