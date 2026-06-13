@extends('layouts.app')

@section('content')
<div class="relative w-full min-h-screen flex flex-col items-center justify-center overflow-hidden py-32 bg-[#0f1115]">
    
    <div class="absolute inset-0 z-0 flex justify-between items-center px-4 md:px-12 pointer-events-none">
        
        <div class="hidden md:flex flex-col space-y-6 transform -rotate-12 -translate-x-12 opacity-20 blur-[1px]">
            @foreach($backgroundMovies->take(3) as $movie)
                <img src="{{ $movie->thumbnail_url }}" alt="Poster" class="w-56 md:w-64 rounded-xl shadow-2xl object-cover aspect-[2/3]">
            @endforeach
        </div>

        <div class="hidden md:flex flex-col space-y-6 transform rotate-12 translate-x-12 opacity-20 blur-[1px]">
            @foreach($backgroundMovies->skip(3)->take(3) as $movie)
                <img src="{{ $movie->thumbnail_url }}" alt="Poster" class="w-56 md:w-64 rounded-xl shadow-2xl object-cover aspect-[2/3]">
            @endforeach
        </div>

    </div>

    <div class="absolute inset-0 z-0 bg-gradient-to-b from-[#0f1115] via-[#0f1115]/80 to-[#0f1115] pointer-events-none"></div>

    
    <div class="relative z-10 w-full flex flex-col items-center px-6 mt-12 md:mt-0">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white tracking-tight">Masuk ke ASIA<span class="text-orange-500">PLAY</span></h1>
            <p class="text-gray-400 text-sm md:text-base leading-relaxed">
                Masuk untuk melanjutkan dan nikmati<br>ribuan film & serial favoritmu.
            </p>
        </div>

        <div class="w-full max-w-[420px] bg-[#16181f] border border-gray-800 rounded-3xl p-8 md:p-10 shadow-2xl flex flex-col items-center transform transition duration-500 hover:border-gray-700">
            
            <div class="mb-6 relative">
                <svg class="w-16 h-16 text-orange-500 drop-shadow-[0_0_15px_rgba(249,115,22,0.4)]" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 7l2-4h2l-2 4m4-4l-2 4m6-4l-2 4m6-4l-2 4m-8 7l4-2.5V17l-4-2.5zM4 7a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2H4z"></path>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-white mb-2">Welcome Back!</h2>
            <p class="text-sm text-gray-400 mb-8 text-center">Masuk dengan akun Google Anda<br>untuk melanjutkan.</p>

            <a href="{{ route('google.login') }}" class="w-full bg-white hover:bg-gray-100 text-gray-900 font-semibold py-3.5 px-4 rounded-xl flex items-center justify-center space-x-3 transition duration-200">
                <svg class="w-6 h-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                <span>Masuk dengan Google</span>
            </a>

            <div class="mt-8 text-xs text-center text-gray-500 leading-relaxed">
                Dengan melanjutkan, Anda menyetujui<br>
                <a href="#" class="text-orange-500 hover:text-orange-400 transition">Syarat Penggunaan</a> dan <a href="#" class="text-orange-500 hover:text-orange-400 transition">Kebijakan Privasi</a> kami.
            </div>
        </div>

    </div>
</div>
@endsection