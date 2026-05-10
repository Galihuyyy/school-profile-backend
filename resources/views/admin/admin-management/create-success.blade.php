<x-layouts.admin-layout :hiddenHeader="true">
    <div class="min-h-full flex items-center justify-center" 
         x-data="{ 
            count: 10, 
            init() {
                let timer = setInterval(() => {
                    if (this.count > 1) this.count--;
                    else {
                        clearInterval(timer);
                        window.location.href = '{{ route('admin::school-settings.index') }}';
                    }
                }, 1000);
            }
         }">
        
        <div class="w-full bg-white p-10 rounded-[3rem] shadow-2xl shadow-slate-200 border border-white text-center flex flex-col items-center">
            <!-- Success Icon -->
            <div class="w-24 h-24 bg-teal-50 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 text-teal-600 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
    
            <h1 class="text-3xl font-black text-slate-800 mb-4">Berhasil!</h1>
            <p class="text-slate-600 leading-relaxed mb-8 max-w-lg">
                {{ session('success') }} Silahkan instruksikan admin tersebut untuk <span class="font-bold text-slate-800">cek email</span> dan melakukan aktivasi agar dapat masuk ke sistem.
            </p>
    
            <!-- Countdown Badge -->
            <div class="inline-flex items-center gap-3 px-6 py-3 bg-slate-900 text-white rounded-2xl text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 animate-spin text-teal-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span>Dialihkan dalam <span x-text="count" class="font-bold text-teal-400"></span> detik...</span>
            </div>
    
            <div class="mt-8 pt-8 border-t border-slate-100">
                <a href="{{ route('admin::school-settings.index') }}" class="text-teal-600 font-bold hover:underline">Kembali sekarang</a>
            </div>
        </div>
    </div>
</x-layouts.admin-layout>

