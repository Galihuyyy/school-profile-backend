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
                    @if ( !isset($item['permission']) || hasPermission($item['permission']) )
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all hover:pl-5
                            {{ isActive($item['route']) ? 'bg-teal-50 text-teal-600 shadow-sm' : 'text-slate-400 hover:text-teal-600' }}">

                            <span class="font-bold">{{ $item['title'] }}</span>
                        </a>
                    @endif
                @endif


                {{-- GROUP MENU --}}
                @if (isset($item['children']))
                    @php $open = isGroupActive($item['children']); @endphp
                    
                    @if (isset($item['children']))
                        <div>
                            <div
                                class="px-4 py-3 font-semibold tracking-wider text-sm
                                {{ $open ? 'text-teal-600' : 'text-slate-400' }}">
                                {{ $item['title'] }}
                            </div>

                            <div class="ml-4 space-y-1">
                                @foreach ($item['children'] as $child)
                                    @if ( !isset($child['permission']) || hasPermission($child['permission']) )
                                        <a href="{{ route($child['route']) }}"
                                            class="block px-4 py-2 rounded-lg text-sm transition-all hover:pl-5
                                            {{ isActive($child['route']) ? 'bg-teal-50 text-teal-600' : 'text-slate-400 hover:text-teal-600' }}">

                                            {{ $child['title'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </nav>
    </div>

    <form class="mt-auto p-8 border-t border-slate-100" method="POST" action="{{ route('admin::logout') }}">
        @csrf
        <button type="submit" class="flex items-center gap-3 text-red-500 font-bold hover:gap-5 transition-all">
            <span>Logout</span>
        </button>
    </form>
</aside>
