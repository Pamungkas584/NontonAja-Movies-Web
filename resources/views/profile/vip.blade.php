@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen pt-[72px] bg-[#0f1115]">
    
    <aside class="w-full md:w-72 bg-[#12141a] border-r border-gray-800 flex flex-col justify-between">
        <div>
            <div class="px-8 py-6">
                <p class="text-xs font-bold text-gray-500 tracking-wider mb-4">PENGATURAN</p>
            </div>
            
            <nav class="flex flex-col space-y-1">
                <a href="{{ route('profile.index') }}" class="flex items-center px-8 py-4 border-l-4 border-transparent text-gray-400 hover:text-white hover:bg-gray-800/20 transition">
                    <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium text-sm">Akun Saya</span>
                </a>

                <a href="{{ route('profile.vip') }}" class="flex items-center px-8 py-4 border-l-4 border-orange-500 bg-gray-800/40 text-orange-500 transition">
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
                <p class="text-xs text-gray-400 mb-3">Kunjungi Pusat Bantuan</p>
                <a href="#" class="text-xs font-semibold text-orange-500 hover:text-orange-400 flex items-center">
                    Pusat Bantuan <span class="ml-1">→</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="flex-1 px-8 py-12 md:px-16 max-w-6xl">
        
        <div class="mb-12">
            <div class="flex items-center space-x-4 mb-4">
                <h1 class="text-4xl font-bold text-white">VIP</h1>
                <div class="w-10 h-10 rounded-full border border-orange-500/30 bg-orange-500/10 flex items-center justify-center text-orange-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-400 text-sm md:text-base max-w-md">Tingkatkan pengalaman menonton Anda dengan berlangganan NONTONAJA VIP.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="flex items-start space-x-4">
                <div class="mt-1 text-orange-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-1">Tonton tanpa iklan</h4>
                    <p class="text-xs text-gray-400 leading-relaxed">Nikmati semua konten favorit tanpa gangguan iklan.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="mt-1 text-orange-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-1">Kualitas terbaik</h4>
                    <p class="text-xs text-gray-400 leading-relaxed">Streaming dalam kualitas Full HD hingga 4K.</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="mt-1 text-orange-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-1">Simpan ke WatchList</h4>
                    <p class="text-xs text-gray-400 leading-relaxed">Simpan film dan serial favorit untuk ditonton kapan saja.</p>
                </div>
            </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-6">Pilih Paket Langganan</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <div class="relative bg-[#181a20] border-2 border-orange-500 rounded-2xl p-8 shadow-2xl flex flex-col">
                <div class="absolute -top-3 left-6 bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-sm tracking-wider">POPULER</div>
                
                <h4 class="text-xl font-bold text-white mb-4">1 Bulan</h4>
                <div class="mb-8">
                    <span class="text-3xl font-bold text-white">Rp 60.000</span>
                </div>

                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Akses semua konten
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Tonton tanpa iklan
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Kualitas Full HD
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Download & tonton offline
                    </li>
                    <li class="flex items-start text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="leading-relaxed">Bisa digunakan di semua perangkat</span>
                    </li>
                </ul>

                <button class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-3.5 rounded-xl transition duration-200">
                    Berlangganan
                </button>
            </div>

            <div class="bg-[#16181f] border border-gray-800 rounded-2xl p-8 flex flex-col hover:border-gray-600 transition duration-300">
                <h4 class="text-xl font-bold text-white mb-4">3 Bulan</h4>
                <div class="mb-2">
                    <span class="text-3xl font-bold text-white">Rp 150.000</span>
                </div>
                <p class="text-xs text-gray-400 mb-6">Hemat 17%</p>

                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Akses semua konten
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Tonton tanpa iklan
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Kualitas Full HD
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Download & tonton offline
                    </li>
                    <li class="flex items-start text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="leading-relaxed">Bisa digunakan di semua perangkat</span>
                    </li>
                </ul>

                <button class="w-full bg-transparent border border-gray-600 hover:border-gray-400 hover:text-white text-gray-300 font-semibold py-3.5 rounded-xl transition duration-200">
                    Berlangganan
                </button>
            </div>

            <div class="bg-[#16181f] border border-gray-800 rounded-2xl p-8 flex flex-col hover:border-gray-600 transition duration-300">
                <h4 class="text-xl font-bold text-white mb-4">1 Tahun</h4>
                <div class="mb-2">
                    <span class="text-3xl font-bold text-white">Rp 600.000</span>
                </div>
                <p class="text-xs text-gray-400 mb-6">Hemat 17%</p>

                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Akses semua konten
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Tonton tanpa iklan
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Kualitas Full HD
                    </li>
                    <li class="flex items-center text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Download & tonton offline
                    </li>
                    <li class="flex items-start text-sm text-gray-300">
                        <svg class="w-4 h-4 text-white mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="leading-relaxed">Bisa digunakan di semua perangkat</span>
                    </li>
                </ul>

                <button class="w-full bg-transparent border border-gray-600 hover:border-gray-400 hover:text-white text-gray-300 font-semibold py-3.5 rounded-xl transition duration-200">
                    Berlangganan
                </button>
            </div>
        </div>

        <div class="flex items-center text-gray-400 text-sm mt-4">
            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            Pembayaran aman & terenkripsi. Batalkan kapan saja.
        </div>

    </main>
</div>
@endsection