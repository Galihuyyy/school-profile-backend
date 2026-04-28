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
            <img src="{{ asset('images/logo-smk.png') }}" alt="logo smkn 1 sukorejo" class="w-20 h-20 rounded-full mx-auto mb-6 shadow-lg shadow-teal-600/30">
            <h1 class="text-3xl font-extrabold text-slate-900">Admin Portal</h1>
            <p class="text-slate-500 mt-2">Silakan masuk untuk mengelola data sekolah</p>
        </div>

        <form method="post" action="{{ route('admin::login.process') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Email / Username</label>
                <input type="text" value="{{ old('login') }}" name="login" class="w-full px-5 py-4 rounded-2xl bg-slate-50 outline-none border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white focus:outline-none transition-all" placeholder="admin@smkn1abcd.sch.id">
                @error('login')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-5 py-4 rounded-2xl bg-slate-50 outline-none border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white focus:outline-none transition-all" placeholder="••••••••">
            </div>
            <button class="w-full py-4 bg-teal-600 text-white font-bold rounded-2xl shadow-lg shadow-teal-600/30 hover:bg-teal-700 transition-all duration-300">
                Masuk
            </button>
        </form>
        
        <p class="text-center mt-8 text-sm text-slate-400">
            &copy; 2026 Management System SMKN 1 ABCD
        </p>
    </div>

</body>
</html>