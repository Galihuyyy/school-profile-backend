<header class="flex justify-between items-center mb-12" x-data="{ active : false }">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900">{{ $title ?? '' }}</h2>
        <p class="text-slate-500 mt-1">{{ $subtitle ?? '' }}</p>
    </div>
    <div class=" relative">
        <div class="text-right flex items-center gap-4 cursor-pointer" x-on:click="active = !active">
            <div>
                <p class="font-bold text-slate-900">Administrator</p>
                <p class="text-xs text-teal-600">Super Admin</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-100 border-2 border-teal-500"></div>
        </div>

        <div class="h-xl w-xs bg-white absolute top-full right-0 rounded-md p-2 shadow-md origin-top-right" x-show="active" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.outside="active = false">
            <a href="{{ route('admin::admins.edit', auth()->user()->id) }}" class="card bg-gray-200 rounded-sm p-2 flex flex-col items-center justify-center">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 border-2 border-teal-500"></div>
                <div class="text-center">
                    <p class="font-bold text-slate-900">{{ auth()->user()->name }} • {{ auth()->user()->username }}</p>
                    <p class="text-xs text-teal-600">Super Admin</p>
                </div>
            </a>

            <div class="px-2 text-slate-600">
                <p class="py-2 text-xs font-medium">Profil Admin Lainnya</p>
                @foreach ($account as $acc)
                    <a href="{{ route('admin::admins.edit', $acc->id) }}">
                        <div class="flex items-center gap-3 transition-colors p-1 rounded cursor-pointer hover:bg-slate-100">
                            <div class="w-8 h-8 rounded-md bg-teal-100 border-2 border-teal-500 uppercase flex items-center justify-center font-semibold">{{ $acc->username[0] }}</div>
                            <p class="text-xs">{{ $acc->name }} • {{ $acc->username }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            @if (hasPermission('manage_admin'))
                <a href="{{ route('admin::admins.create') }}" class="mt-2 flex items-center justify-center gap-3 transition-colors px-1 py-2 rounded bg-slate-100 w-full">
                    <p class="text-xs">Tambah Admin</p>
                </a>
            @endif
        </div>
    </div>
</header>
