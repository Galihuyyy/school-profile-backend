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

<div x-data="{ sidebarOpen: false }" x-cloak>

    <!-- MOBILE HEADER -->
    <header class="md:hidden fixed top-0 left-0 right-0 h-16 bg-white border-b border-slate-200 z-30 px-4 flex items-center justify-start gap-3">
        <button @click="sidebarOpen = true" class="text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 50 50" fill="currentColor">
                <path d="M 3 9 A 1.0001 1.0001 0 1 0 3 11 L 47 11 A 1.0001 1.0001 0 1 0 47 9 L 3 9 z M 3 24 A 1.0001 1.0001 0 1 0 3 26 L 47 26 A 1.0001 1.0001 0 1 0 47 24 L 3 24 z M 3 39 A 1.0001 1.0001 0 1 0 3 41 L 47 41 A 1.0001 1.0001 0 1 0 47 39 L 3 39 z"></path>
            </svg>
        </button>

        <div class="flex items-center gap-3">
            <span class="text-lg font-extrabold text-slate-900 tracking-tight">
                AdminPanel
            </span>
        </div>
    </header>

    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-30 md:hidden"></div>

    <aside class="w-72 bg-white border-r border-slate-200 flex flex-col fixed h-full z-40 transition-transform duration-300" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        <div class="p-8">
            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center text-white font-bold">
                        A
                    </div>

                    <span class="text-xl font-extrabold text-slate-900 tracking-tight">
                        AdminPanel
                    </span>
                </div>

                <button @click="sidebarOpen = false" class="md:hidden text-slate-500">
                    ✕
                </button>
            </div>


            <nav class="space-y-2">
                @foreach (config('sidebar') as $item)
                    {{-- SINGLE MENU --}}
                    @if (!isset($item['children']))
                        @if (!isset($item['permission']) || hasPermission($item['permission']))
                            <a href="{{ route($item['route']) }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all hover:pl-5 {{ isActive($item['route']) ? 'bg-teal-50 text-teal-600 shadow-sm' : 'text-slate-400 hover:text-teal-600' }}">
                                <span class="font-bold">{{ $item['title'] }}</span>
                            </a>
                        @endif
                    @endif

                    {{-- GROUP MENU --}}
                    @if (isset($item['children']))
                        @php $open = isGroupActive($item['children']); @endphp

                        <div>
                            <div class="px-4 py-3 font-semibold tracking-wider text-sm {{ $open ? 'text-teal-600' : 'text-slate-400' }}"> {{ $item['title'] }}</div>

                            <div class="ml-4 space-y-1">
                                @foreach ($item['children'] as $child)
                                    @if (!isset($child['permission']) || hasPermission($child['permission']))
                                        <a href="{{ route($child['route']) }}" class="block px-4 py-2 rounded-lg text-sm transition-all hover:pl-5 {{ isActive($child['route']) ? 'bg-teal-50 text-teal-600' : 'text-slate-400 hover:text-teal-600' }}">
                                            {{ $child['title'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </nav>
        </div>

        <!-- LOGOUT -->
        <form class="mt-auto p-8 border-t border-slate-100" method="POST" action="{{ route('admin::logout') }}">
            @csrf

            <button type="submit" class="flex items-center gap-3 text-red-500 font-bold hover:gap-5 transition-all">
                <span>Logout</span>
            </button>
        </form>
    </aside>
</div>