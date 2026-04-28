@php
    function isActive($route)
    {
        return request()->routeIs($route);
    }

    function isGroupActive($children)
    {
        foreach ($children as $child) {
            if (request()->routeIs($child['route'])) {
                return true;
            }
        }
        return false;
    }
@endphp

<aside class="w-72 bg-white border-r border-slate-200 flex flex-col fixed h-full z-20">
    <div class="p-8">

        <div class="flex items-center gap-3 mb-10">
            <div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center text-white font-bold">A</div>
            <span class="text-xl font-extrabold text-slate-900 tracking-tight">AdminPanel</span>
        </div>

        <nav class="space-y-2">
            @foreach (config('sidebar') as $item)
                {{-- SINGLE MENU --}}
                @if (!isset($item['children']))
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all
                       {{ isActive($item['route']) ? 'bg-teal-50 text-teal-600 shadow-sm' : 'text-slate-400 hover:text-teal-600' }}">

                        <span class="font-bold">{{ $item['title'] }}</span>
                    </a>
                @endif


                {{-- GROUP MENU --}}
                @if (isset($item['children']))
                    @php $open = isGroupActive($item['children']); @endphp

                    <div>
                        <div
                            class="px-4 py-3 font-bold cursor-pointer
                            {{ $open ? 'text-teal-600' : 'text-slate-400' }}">
                            {{ $item['title'] }}
                        </div>

                        <div class="ml-4 space-y-1">
                            @foreach ($item['children'] as $child)
                                <a href="{{ route($child['route']) }}"
                                    class="block px-4 py-2 rounded-lg text-sm transition-all
                                   {{ isActive($child['route']) ? 'bg-teal-50 text-teal-600' : 'text-slate-400 hover:text-teal-600' }}">

                                    {{ $child['title'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>
    </div>

    <div class="mt-auto p-8 border-t border-slate-100">
        <button class="flex items-center gap-3 text-red-500 font-bold hover:gap-5 transition-all">
            <span>Logout</span>
        </button>
    </div>
</aside>
