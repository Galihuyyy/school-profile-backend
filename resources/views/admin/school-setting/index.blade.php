<x-layouts.admin-layout>
    <x-slot name="title">Pengaturan Sekolah</x-slot>
    <x-slot name="subtitle">Konfigurasi detail sekolah</x-slot>
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden" x-data="formHandler(@js($setting))" x-init="init()" x-cloak>
        <div class="p-10 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-xl text-slate-900">Informasi Umum</h3>
        </div>
        
        <form class="p-10 space-y-10" method="post" action="{{ route('admin::school-settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col md:flex-row items-center gap-10">
                <label class="relative group cursor-pointer">

                    <div class="w-32 h-32 rounded-4xl bg-slate-100 border-2 border-dashed border-slate-300 transition-all flex items-center justify-center overflow-hidden"
                        :class="!readonly 
                            ? 'hover:border-teal-600 hover:text-teal-600 cursor-pointer' 
                            : 'cursor-default'"
                    >

                        <!-- preview dari Alpine -->
                        <template x-if="logoPreview">
                            <img :src="logoPreview" class="w-full h-full object-cover">
                        </template>

                        <!-- fallback dari DB -->
                        <template x-if="!logoPreview && form.logo">
                            <img :src="form.logo" class="w-full h-full object-cover">
                        </template>

                        <!-- icon -->
                        <template x-if="!logoPreview && !form.logo">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>

                        </template>
                    </div>

                    <!-- INPUT FILE -->
                    <input 
                        type="file"
                        name="logo"
                        accept="image/*"
                        :disabled="readonly"
                        class="hidden"
                        @change="handleLogoUpload"
                    >
                </label>

                <div class="flex-1">
                    <h4 class="font-bold text-slate-800 mb-1">Logo Sekolah</h4>
                    <p class="text-sm text-slate-400">Gunakan format PNG atau JPG transparan (Maks. 2MB)</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Nama Sekolah</label>
                    <input type="text" x-model="form.name" name="name" value="{{ old('name', $setting->name) }}" :disabled="readonly" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Akreditasi</label>
                    <select x-model="form.akreditasi" name="akreditasi" value="{{ old('akreditasi', $setting->akreditasi) }}" :disabled="readonly" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all appearance-none cursor-pointer">
                        <option x-show="readonly" value="Belum di set">Belum di set</option>
                        <option value="A">A (Unggul)</option>
                        <option value="B">B (Baik)</option>
                        <option value="C">C (Cukup)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">No. Telepon Sekolah</label>
                    <input type="tel" x-model="form.telephone" name="telephone" value="{{ old('telephone', $setting->telephone) }}" :disabled="readonly" placeholder="(021) xxxxxxx" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Email Resmi Sekolah</label>
                    <input type="email" x-model="form.email" name="email" value="{{ old('email', $setting->email) }}" :disabled="readonly" placeholder="info@sekolah.sch.id" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-4">Status Sekolah</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" x-model="form.status" value="negeri" name="status" :disabled="readonly" class="w-5 h-5 text-teal-600 focus:ring-teal-500 border-slate-300">
                            <span class="text-slate-700 group-hover:text-teal-600 transition-colors">Negeri</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" x-model="form.status" value="swasta" name="status" :disabled="readonly" class="w-5 h-5 text-teal-600 focus:ring-teal-500 border-slate-300">
                            <span class="text-slate-700 group-hover:text-teal-600 transition-colors">Swasta</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">URL Video Profil (YouTube)</label>
                    <div class="relative">
                        <input type="url" x-model="form.profile_video" name="profile_video" value="{{ old('profile_video', $setting->profile_video) }}" :disabled="readonly" placeholder="https://youtube.com/watch?v=..." class="w-full p-4 pl-12 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all">
                        <div class="absolute left-4 top-4 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Deskripsi Singkat</label>
                    <textarea x-model="form.description" name="description" value="{{ old('description', $setting->description) }}" :disabled="readonly" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 h-32 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all"></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Lokasi / Alamat Lengkap</label>
                    <textarea x-model="form.location" name="location" value="{{ old('location', $setting->location) }}" :disabled="readonly" placeholder="Jl. Raya Teknologi No. 123..." class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 h-24 focus:ring-2 focus:ring-teal-500 focus:bg-white outline-none transition-all"></textarea>
                </div>
            </div>
            @if (hasPermission('school_info'))
                <div class="space-y-4">

                    @foreach (['instagram', 'facebook', 'tiktok', 'youtube'] as $socmed)
                        <div class="flex items-center justify-between p-4 rounded-xl border border-slate-200">
                            <div>
                                <p class="font-semibold text-slate-700 capitalize">{{ $socmed }}</p>
                                <p class="text-sm text-slate-400" x-text="form.{{ $socmed }}_url || 'Belum di set'"></p>
                            </div>

                            <button 
                                type="button"
                                @click="openSocmed('{{ $socmed }}_url')"
                                class="text-teal-600 font-bold hover:underline"
                            >
                                <span x-text="form.{{ $socmed }}_url ? 'Edit' : 'Set'"></span>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (hasPermission('school_info'))
                <div x-show="readonly" class="pt-10 flex justify-end gap-4 border-t border-slate-100">
                    <a href="{{ route('admin::school-settings.edit') }}" type="submit" class="px-8 py-3 flex gap-x-3 bg-teal-600 text-white rounded-xl font-bold shadow-lg shadow-teal-600/20 hover:bg-teal-700 hover:-translate-y-1 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        Ubah Data
                    </a>
                </div>
                <div x-show="!readonly" class="pt-10 flex justify-end gap-4 border-t border-slate-100">
                    <button type="button" class="px-8 py-3 cursor-pointer bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-colors">Batalkan</button>
                    <button type="submit" class="px-8 py-3 cursor-pointer bg-teal-600 text-white rounded-xl font-bold shadow-lg shadow-teal-600/20 hover:bg-teal-700 hover:-translate-y-1 transition-all">Simpan Perubahan</button>
                </div>

            @endif
        </form>

        @if (hasPermission('school_info'))
            @include('admin.school-setting.socmed-modal')
        @endif
    </div>

    <x-slot name="scripts">
        @include('admin.school-setting.script')
    </x-slot>
</x-layouts.admin-layout>