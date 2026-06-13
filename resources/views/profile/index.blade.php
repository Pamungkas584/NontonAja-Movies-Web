@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen pt-[72px] bg-[#0f1115]">
    
    <aside class="w-full md:w-72 bg-[#12141a] border-r border-gray-800 flex flex-col justify-between">
        <div>
            <div class="px-8 py-6">
                <p class="text-xs font-bold text-gray-500 tracking-wider mb-4">PENGATURAN</p>
            </div>
            
            <nav class="flex flex-col space-y-1">
                <a href="#" class="flex items-center px-8 py-4 border-l-4 border-orange-500 bg-gray-800/40 text-orange-500 transition">
                    <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium text-sm">Akun Saya</span>
                </a>

                <a href="#" class="flex items-center px-8 py-4 border-l-4 border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20 transition">
                    <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <span class="font-medium text-sm">VIP</span>
                </a>
            </nav>
        </div>

        <div class="p-8">
            <div class="bg-[#181a20] rounded-xl p-5 border border-gray-800">
                <div class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h4 class="text-sm font-bold text-white mb-1">Butuh bantuan?</h4>
                <p class="text-xs text-gray-400 mb-3 line-clamp-2">Kunjungi Pusat Bantuan</p>
                <a href="#" class="text-xs font-semibold text-orange-500 hover:text-orange-400 flex items-center">
                    Pusat Bantuan <span class="ml-1">→</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="flex-1 relative">
        <div class="absolute inset-0 z-0 h-80 pointer-events-none">
            <img src="{{ $bannerMovie->banner_url ?? 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba' }}" alt="Banner" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0f1115] via-[#0f1115]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0f1115] to-transparent"></div>
        </div>

        <div class="relative z-10 px-8 py-12 md:px-16 max-w-5xl">
            
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-3xl font-bold text-white mb-2">Akun Saya</h1>
            <p class="text-gray-400 text-sm mb-10">Kelola informasi akun dan preferensi Anda</p>

            <div class="bg-[#16181f] border border-gray-800 rounded-2xl p-8 mb-12 shadow-xl">
                <h2 class="text-lg font-bold text-white mb-6">Informasi Akun</h2>

                <div class="flex items-center justify-between py-6 border-b border-gray-800/50">
                    <div class="flex items-center space-x-6">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Nama</p>
                            <p class="text-lg font-semibold text-white">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('editNameModal').classList.remove('hidden')" class="px-5 py-2 rounded-full border border-gray-600 text-gray-300 hover:text-white hover:border-gray-400 flex items-center text-sm transition">
                        Ubah 
                        <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </div>

                <div class="flex items-center justify-between py-6">
                    <div class="flex items-center space-x-6">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Email</p>
                            <p class="text-lg font-semibold text-white">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    </div>
            </div>

            <div class="flex justify-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-[#ff6b00] hover:bg-[#e56000] text-white font-semibold py-3 px-8 rounded-lg flex items-center shadow-[0_4px_14px_0_rgba(255,107,0,0.39)] transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>

        </div>
    </main>

</div>

<div id="editNameModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/80 backdrop-blur-sm">
    <div class="bg-[#181a20] border border-gray-800 rounded-2xl w-full max-w-md p-6 shadow-2xl">
        <h3 class="text-xl font-bold text-white mb-4">Ubah Nama</h3>
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label class="block text-sm text-gray-400 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-orange-500" required>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('editNameModal').classList.add('hidden')" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-lg text-sm font-medium bg-orange-600 hover:bg-orange-700 text-white transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection