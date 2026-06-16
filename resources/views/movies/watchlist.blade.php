@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0f1115] pt-28 px-8 md:px-16 pb-20">
    
    <div class="text-gray-400 text-sm mb-6 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a>
        <span>›</span>
        <span class="text-white">Daftar Saya</span>
    </div>

    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Daftar Saya</h1>
        <p class="text-gray-400 text-sm">Kumpulan film dan serial yang ingin Anda tonton</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-4 gap-y-10 mb-12">
        @forelse($watchlistMovies as $movie)
            <a href="{{ route('movies.show', $movie->id) }}" class="group cursor-pointer block">
                <div class="relative rounded-xl overflow-hidden mb-3 aspect-[2/3] bg-gray-800 shadow-lg">
                    <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition transform group-hover:scale-105 duration-300">
                    
                    <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded flex items-center shadow-md">
                        <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                    </div>
                </div>
                <h3 class="text-white font-bold text-sm md:text-base line-clamp-1 group-hover:text-orange-500 transition">{{ $movie->title }}</h3>
                <p class="text-gray-400 text-xs md:text-sm mt-1">{{ $movie->year }} • {{ $movie->category }}</p>
            </a>
        @empty
            <div class="col-span-full py-20 text-center border border-dashed border-gray-800 rounded-2xl bg-[#16181f]/30">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                </svg>
                <h3 class="text-white font-semibold text-lg mb-1">Daftar tontonan Anda kosong</h3>
                <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Belum ada film yang ditambahkan. Jelajahi katalog dan klik "+ Daftar Saya" pada film yang Anda sukai.</p>
                <a href="{{ route('movies.index') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-medium py-2.5 px-6 rounded-lg transition shadow-lg text-sm">
                    Jelajahi Film
                </a>
            </div>
        @endforelse
    </div>

    @if($watchlistMovies->hasPages())
    <div class="flex items-center justify-center space-x-2 mt-12">
        @if ($watchlistMovies->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 cursor-not-allowed">❮</span>
        @else
            <a href="{{ $watchlistMovies->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">❮</a>
        @endif

        <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-600 text-white font-bold">{{ $watchlistMovies->currentPage() }}</span>
        
        @if($watchlistMovies->hasMorePages())
            <a href="{{ $watchlistMovies->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">{{ $watchlistMovies->currentPage() + 1 }}</a>
            <span class="w-10 h-10 flex items-center justify-center text-gray-500">...</span>
            <a href="?page={{ $watchlistMovies->lastPage() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">{{ $watchlistMovies->lastPage() }}</a>
        @endif

        @if ($watchlistMovies->hasMorePages())
            <a href="{{ $watchlistMovies->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">❯</a>
        @else
            <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 cursor-not-allowed">❯</span>
        @endif
    </div>
    @endif

</div>
@endsection