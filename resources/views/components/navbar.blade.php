<nav class="w-full flex justify-center mt-6 fixed z-99">
    <div class="max-w-7xl mx-auto w-full flex items-center justify-between px-6 py-3 rounded-full bg-white/70 backdrop-blur-md shadow-sm border border-gray-200">

        <!-- Logo / Title -->
        <h1 class="text-lg font-semibold tracking-wide text-gray-800 uppercase">
            {{ $schoolSetting->name }}
        </h1>

        <!-- Menu -->
        <ul class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
            <li class="hover:text-gray-900 transition capitalize"><a href="/#beranda">beranda</a></li>
            <li class="hover:text-gray-900 transition capitalize"><a href="/#profil">profil</a></li>
            <li class="hover:text-gray-900 transition capitalize"><a href="/#jurusan">jurusan</a></li>
            <li class="hover:text-gray-900 transition capitalize"><a href="/#guru">guru</a></li>
            <li class="hover:text-gray-900 transition capitalize"><a href="/#berita">berita</a></li>
            <li class="hover:text-gray-900 transition capitalize"><a href="/lowongan">lowongan</a></li>
            <li class="hover:text-gray-900 transition capitalize"><a href="/#kontak">kontak</a></li>
        </ul>

    </div>
</nav>