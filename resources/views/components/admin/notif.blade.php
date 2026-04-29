@php
    $success = session('success');
    $error = session('error') ?? ($errors->any() ? $errors->first() : null);
    $message = $success ?? $error;
    $type = $success ? 'success' : ($error ? 'error' : null);

    $colors = [
        'success' => [
            'bg' => 'bg-teal-600', 
            'border' => 'border-teal-500',
            'text' => 'text-white',
            'icon_bg' => 'bg-white',
            'icon_color' => 'text-teal-600',
            'shadow' => 'shadow-2xl shadow-teal-600/30',
            'close_button' => 'text-white hover:bg-white/20'
        ],
        'error' => [
            'bg' => 'bg-red-600',
            'border' => 'border-red-500',
            'text' => 'text-white',
            'icon_bg' => 'bg-white',
            'icon_color' => 'text-red-600',
            'shadow' => 'shadow-2xl shadow-red-600/30',
            'close_button' => 'text-white hover:bg-white/20'
        ]
    ][$type] ?? null;
@endphp

@if($type && $colors && !empty($message))
    <div id="notif-container" 
        class="fixed top-6 right-6 z-9999 w-full max-w-sm animate-fade-in-down p-4 md:p-0">
        <div class="flex items-center justify-between p-4 rounded-4xl {{ $colors['bg'] }} border {{ $colors['border'] }} {{ $colors['shadow'] }} transition-all duration-300">
            <div class="flex items-center gap-4 {{ $colors['text'] }}">
                <div class="w-10 h-10 {{ $colors['icon_bg'] }} rounded-2xl flex items-center justify-center shadow-sm {{ $colors['icon_color'] }} shrink-0">
                    @if($type == 'success')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @endif
                </div>
                
                <div class="flex-1">
                    <p class="font-bold leading-none mb-1 text-sm md:text-base capitalize">{{ $type }}!</p>
                    <p class="text-xs md:text-sm opacity-90 leading-tight font-medium">{{ $message }}</p>
                </div>
            </div>
            
            <button onclick="closeNotif()" class="p-2 {{ $colors['close_button'] }} rounded-xl transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

<script>
    function closeNotif() {
        const notif = document.getElementById('notif-container');
        if (notif) {
            notif.style.opacity = '0';
            notif.style.transform = 'translateY(-20px)';
            setTimeout(() => notif.remove(), 300);
        }
    }

    // Auto close setelah 5 detik
    setTimeout(() => {
        closeNotif();
    }, 5000);
</script>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
        animation: fade-in-down 0.5s ease-out forwards;
    }
</style>
@endif