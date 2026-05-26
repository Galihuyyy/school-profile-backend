<nav class="w-full flex justify-center mt-6 fixed z-99">
    <div class="max-w-7xl mx-auto w-full flex items-center justify-between px-6 py-3 rounded-full bg-white/70 backdrop-blur-md shadow-sm border border-gray-200">

        <!-- Logo / Title -->
        <h1 class="text-lg font-semibold tracking-wide text-gray-800 uppercase">
            {{ schoolSetting('name') }}
        </h1>

        <!-- Menu -->
        <div x-data="{ open: false }" class="relative">
            <!-- Menu Desktop -->
            <ul class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <li class="hover:text-gray-900 transition capitalize"><a href="/#beranda">beranda</a></li>
                <li class="hover:text-gray-900 transition capitalize"><a href="/#profil">profil</a></li>
                <li class="hover:text-gray-900 transition capitalize"><a href="/#jurusan">jurusan</a></li>
                <li class="hover:text-gray-900 transition capitalize"><a href="/#guru">guru</a></li>
                <li class="hover:text-gray-900 transition capitalize"><a href="/#berita">berita</a></li>
                <li class="hover:text-gray-900 transition capitalize"><a href="/lowongan">lowongan</a></li>
                <li class="hover:text-gray-900 transition capitalize"><a href="/#kontak">kontak</a></li>
            </ul>

            <!-- Hamburger -->
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" class="md:hidden scale-50 cursor-pointer"
                @click="open = !open"
            >
                <path d="M 3 9 A 1.0001 1.0001 0 1 0 3 11 L 47 11 A 1.0001 1.0001 0 1 0 47 9 L 3 9 z M 3 24 A 1.0001 1.0001 0 1 0 3 26 L 47 26 A 1.0001 1.0001 0 1 0 47 24 L 3 24 z M 3 39 A 1.0001 1.0001 0 1 0 3 41 L 47 41 A 1.0001 1.0001 0 1 0 47 39 L 3 39 z"></path>
            </svg>

            <!-- Mobile Menu -->
            <ul x-show="open" x-transition class="absolute top-full right-0 mt-2 bg-white shadow-lg rounded-xl p-4 flex flex-col gap-3 text-sm font-medium text-gray-600 md:hidden">
                <li><a href="/#beranda">beranda</a></li>
                <li><a href="/#profil">profil</a></li>
                <li><a href="/#jurusan">jurusan</a></li>
                <li><a href="/#guru">guru</a></li>
                <li><a href="/#berita">berita</a></li>
                <li><a href="/lowongan">lowongan</a></li>
                <li><a href="/#kontak">kontak</a></li>
            </ul>
        </div>
    </div>
</nav>