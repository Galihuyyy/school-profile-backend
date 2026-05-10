<x-layouts.admin-layout>
    <x-slot name="title">{{ $mode === 'create' ? 'Tambah Admin' : 'Edit Admin' }}</x-slot>
    <x-slot name="subtitle">Tambahkan data admin baru ke sistem.</x-slot>


        <form action="{{ $mode === 'create' ? route('admin::admins.store') : route('admin::admins.update', optional($account)->id) }}" method="POST" class="space-y-8" x-data="formHandler()" x-init="init()">
            @csrf
            @if($mode !== 'create')
                @method('PUT')
            @endif
            <!-- Card 1: Informasi Dasar -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <div class="flex items-center gap-3 mb-6 text-teal-600">
                    <div class="w-10 h-10 bg-teal-50 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Informasi Akun</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" x-model="form.name" :disabled="readonly" name="name" value="{{ old('name', optional($account)->name) }}" placeholder="John Doe" class="w-full p-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Username</label>
                        <input type="text" x-model="form.username" :disabled="readonly" name="username" value="{{ old('username', optional($account)->username) }}" placeholder="johndoe123" class="w-full p-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <input type="email" x-model="form.email" :disabled="readonly" name="email" value="{{ old('email', optional($account)->email) }}" placeholder="john@example.com" class="w-full p-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                    </div>
                    <div x-show="mode === 'create'">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <input type="password" x-model="form.password" :disabled="readonly" name="password" placeholder="••••••••" class="w-full p-4 rounded-2xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Card 2: Hak Akses / Rules -->
            @if (hasPermission('manage_admin'))
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                    <div class="flex items-center gap-3 mb-6 text-teal-600">
                        <div class="w-10 h-10 bg-teal-50 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">Hak Akses & Rules</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $permissions = [
                                ['id' => 'school_info', 'label' => 'Merubah Info Sekolah', 'desc' => 'Identitas, logo, dan profil'],
                                ['id' => 'manage_teacher', 'label' => 'Manajemen Guru', 'desc' => 'Tambah, edit, hapus guru'],
                                ['id' => 'manage_admin', 'label' => 'Manajemen Admin', 'desc' => 'Kontrol penuh akun admin'],
                                ['id' => 'manage_post', 'label' => 'Manajemen Post', 'desc' => 'Berita dan artikel sekolah'],
                                ['id' => 'manage_job', 'label' => 'Manajemen Lowongan', 'desc' => 'Info karir dan pekerjaan'],
                            ];
                        @endphp

                        @foreach($permissions as $permission)
                        <label class="group flex items-start gap-4 p-4 rounded-3xl border border-slate-100 bg-slate-50 hover:bg-teal-50 hover:border-teal-200 transition-all cursor-pointer">
                            <div class="mt-1">
                                <input type="checkbox" x-model="form.permissions" name="permissions[]" value="{{ $permission['id'] }}" class="w-5 h-5 rounded-lg text-teal-600 focus:ring-teal-500 border-slate-300">
                            </div>
                            <div>
                                <p class="font-bold text-slate-700 group-hover:text-teal-700">{{ $permission['label'] }}</p>
                                <p class="text-xs text-slate-500 leading-none mt-1">{{ $permission['desc'] }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex justify-end gap-4">
                <a href="{{ route('admin::school-settings.index') }}" type="button" class="px-8 py-4 rounded-2xl font-bold text-slate-500 hover:bg-slate-100 transition-all">Batal</a>
                @if (hasPermission('manage_admin'))
                    <button type="submit" class="px-8 py-4 rounded-2xl font-bold text-white bg-teal-600 hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition-all">Simpan Admin</button>
                @endif
            </div>

        </form>

        <x-slot name="scripts">
            <script>
                function formHandler() {
                    return {
                        mode : @json($mode),
                        readonly : false,
                        admin: @json($account ?? []),
                        currentUserId: {{ auth()->id() }},

                         form: {
                            name: '',
                            username: '',
                            email: '',
                            password: '',
                            permissions: [],
                        },

                        init() {
                            this.readonly = ['edit', 'show'].includes(this.mode) && this.admin?.id != this.currentUserId

                            if (this.admin) {
                                this.form.name = this.admin.name || ''
                                this.form.username = this.admin.username || ''
                                this.form.email = this.admin.email || ''
                                this.form.permissions = this.admin.user_permission?.map(p => p.slug) || []
                            }

                        }
                    }
                }
            </script>
        </x-slot>
</x-layouts.admin-layout>