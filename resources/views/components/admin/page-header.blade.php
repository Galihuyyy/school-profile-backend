<header class="flex justify-between items-center mb-12">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900">{{ $title ?? '' }}</h2>
        <p class="text-slate-500 mt-1">{{ $subtitle ?? '' }}</p>
    </div>
    <div class="flex items-center gap-4">
        <div class="text-right">
            <p class="font-bold text-slate-900">Administrator</p>
            <p class="text-xs text-teal-600">Super Admin</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-teal-100 border-2 border-teal-500"></div>
    </div>
</header>
