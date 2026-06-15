<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NONTONAJA</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="{{ asset('css/app_style.css') }}?v={{ time() }}">
</head>
<body class="bg-[#0f1115] text-white font-sans antialiased">

    <nav class="fixed w-full z-50 bg-gradient-to-b from-black/90 to-transparent px-8 py-4 flex items-center justify-between transition-all duration-300">
        <div class="flex items-center space-x-8">
            <div class="text-2xl font-bold tracking-tighter text-white">
                NONTON<span class="text-orange-500">AJA</span>
            </div>
            <ul class="hidden md:flex space-x-6 text-sm font-medium">
                <li>
                    <a href="{{ url('/') }}" class="cursor-pointer transition {{ request()->is('/') ? 'text-white border-b-2 border-orange-500 pb-1' : 'text-gray-300 hover:text-white' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#" class="cursor-pointer transition {{ request()->is('film') ? 'text-white border-b-2 border-orange-500 pb-1' : 'text-gray-300 hover:text-white' }}">
                        Film
                    </a>
                </li>
                <li>
                    <a href="#" class="cursor-pointer transition {{ request()->is('serial') ? 'text-white border-b-2 border-orange-500 pb-1' : 'text-gray-300 hover:text-white' }}">
                        Serial
                    </a>
                </li>
                <li>
                    <a href="#" class="cursor-pointer transition {{ request()->is('genre') ? 'text-white border-b-2 border-orange-500 pb-1' : 'text-gray-300 hover:text-white' }}">
                        Watchlist Saya
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex items-center space-x-6">
            <div class="relative bg-black/50 rounded-full px-4 py-1.5 border border-gray-700 hidden md:block">
                <input type="text" placeholder="Search for movies, series..." class="bg-transparent border-none text-sm text-white focus:outline-none w-48">
                <span class="text-gray-400 absolute right-3 top-2 text-sm"></span>
            </div>
            
            <div class="relative">
                @auth
                    <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) . '&background=random' }}" alt="Profile" class="w-8 h-8 rounded-full border border-gray-600 object-cover">
                        <span class="text-sm font-medium hidden md:block">{{ Auth::user()->name }} ▾</span>
                    </button>
                    
                    <div id=    "dropdownMenu" class="hidden absolute right-0 mt-3 w-48 bg-[#181a20] rounded-md shadow-lg border border-gray-800 overflow-hidden z-50">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition">Profile</a>                        <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition">Watchlist</a>
                        <a href="#" class="block px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition">History</a>
                        
                        <div class="border-t border-gray-700 my-1"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-3 text-sm text-red-500 hover:bg-gray-800 hover:text-red-400 transition">
                                Log Out
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-full text-sm font-medium transition duration-300">
                        Sign in
                    </a>
                @endauth
            </div>
            </div>
    </nav>
    

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#12141a] border-t border-gray-800 mt-12 pt-12 pb-8 px-8 md:px-16 text-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 text-gray-400">
            <div class="col-span-1">
                <div class="text-2xl font-bold tracking-tighter text-white mb-4">
                    NONTON<span class="text-orange-500">AJA</span>
                </div>
                <p class="mb-6 leading-relaxed">Nikmati pengalaman menonton terbaik dengan koleksi film dan serial favoritmu.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-500 text-white transition">f</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-500 text-white transition">ig</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-500 text-white transition">x</a>
                    <a href="#" class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-500 text-white transition">yt</a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Layanan</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-white transition">Detail Paket</a></li>
                    <li><a href="#" class="hover:text-white transition">Pusat Bantuan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Informasi</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-white transition">Tentang Web</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat Penggunaan</a></li>
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Pemberitahuan Hak Cipta</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Usaha Kami</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Prestasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Manajemen</a></li>
                    <li><a href="#" class="hover:text-white transition">Karir</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-gray-500 mt-12 border-t border-gray-800 pt-6">
            © 2026 NONTONAJA INFORMATHIC STUDENT EXAM . ALL RIGHTS RESERVED.
        </div>
    </footer>

    <script src="{{ asset('script/app_script.js') }}?v={{ time() }}"></script>
</body>
</html>