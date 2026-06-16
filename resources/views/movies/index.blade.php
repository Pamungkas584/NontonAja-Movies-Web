@extends('layouts.app')

@section('content')
<style>
    /* CSS untuk menyembunyikan scrollbar tapi tetap bisa di-scroll horizontal */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<div class="min-h-screen bg-[#0f1115] pt-28 px-8 md:px-16 pb-20">
    
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl md:text-4xl font-bold text-white">Film</h1>
        <button class="flex items-center space-x-2 border border-gray-600 hover:border-white text-gray-300 hover:text-white px-4 py-2 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            <span>Filter</span>
        </button>
    </div>

    <div class="flex space-x-3 overflow-x-auto hide-scrollbar pb-4 mb-8">
        @foreach($categories as $cat)
            <a href="?category={{ $cat }}" class="px-5 py-2 rounded-full whitespace-nowrap text-sm font-medium transition duration-300 {{ $activeCategory == $cat ? 'bg-orange-600 text-white' : 'bg-transparent border border-gray-700 text-gray-400 hover:text-white hover:border-gray-500' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <section class="mb-12 relative">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center group cursor-pointer w-max">
            Film Populer 
            <svg class="w-5 h-5 ml-1 text-orange-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </h2>
        
        <div class="flex space-x-4 overflow-x-auto hide-scrollbar snap-x pb-4">
            @forelse($popularMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="min-w-[160px] md:min-w-[200px] snap-start group cursor-pointer block">
                    <div class="relative rounded-xl overflow-hidden mb-3 aspect-[2/3] bg-gray-800">
                        <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition transform group-hover:scale-105 duration-300">
                        <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded flex items-center">
                            <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                        </div>
                    </div>
                    <h3 class="text-white font-bold text-sm line-clamp-1 group-hover:text-orange-500 transition">{{ $movie->title }}</h3>
                    <p class="text-gray-400 text-xs mt-1">{{ $movie->year }} • {{ $movie->category }}</p>
                </a>
            @empty
                <p class="text-gray-500 text-sm">Belum ada data film populer.</p>
            @endforelse
        </div>
    </section>

    <section class="mb-12 relative">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center group cursor-pointer w-max">
            Film Terbaru 
            <svg class="w-5 h-5 ml-1 text-orange-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </h2>
        
        <div class="flex space-x-4 overflow-x-auto hide-scrollbar snap-x pb-4">
            @forelse($latestMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="min-w-[160px] md:min-w-[200px] snap-start group cursor-pointer block">
                    <div class="relative rounded-xl overflow-hidden mb-3 aspect-[2/3] bg-gray-800">
                        <div class="absolute top-2 left-2 bg-orange-600 text-white text-[10px] font-bold px-2 py-0.5 rounded z-10 tracking-wide">
                            BARU
                        </div>
                        <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition transform group-hover:scale-105 duration-300">
                        <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded flex items-center">
                            <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                        </div>
                    </div>
                    <h3 class="text-white font-bold text-sm line-clamp-1 group-hover:text-orange-500 transition">{{ $movie->title }}</h3>
                    <p class="text-gray-400 text-xs mt-1">{{ $movie->year }} • {{ $movie->category }}</p>
                </a>
            @empty
                <p class="text-gray-500 text-sm">Belum ada data film terbaru.</p>
            @endforelse
        </div>
    </section>

    <section>
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
            <h2 class="text-xl font-bold text-white">Semua Film</h2>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center text-sm text-gray-400 bg-[#16181f] border border-gray-700 rounded-lg px-3 py-2 cursor-pointer hover:border-gray-500 transition">
                    <span class="mr-2">Urutkan:</span>
                    <span class="text-white font-medium mr-2">Populer</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-400 bg-[#16181f] border border-gray-700 rounded-lg px-3 py-2 cursor-pointer hover:border-gray-500 transition hidden md:flex">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Tampilan</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-4 gap-y-8 mb-12">
            @forelse($allMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="group cursor-pointer block">
                    <div class="relative rounded-xl overflow-hidden mb-3 aspect-[2/3] bg-gray-800">
                        <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition transform group-hover:scale-105 duration-300">
                        <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded flex items-center">
                            <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                        </div>
                    </div>
                    <h3 class="text-white font-bold text-sm line-clamp-1 group-hover:text-orange-500 transition">{{ $movie->title }}</h3>
                    <p class="text-gray-400 text-xs mt-1">{{ $movie->year }} • {{ $movie->category }}</p>
                </a>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">
                    Tidak ada film yang ditemukan untuk kategori ini.
                </div>
            @endforelse
        </div>

        @if($allMovies->hasPages())
        <div class="flex items-center justify-center space-x-2 mt-8">
            {{-- Tombol Previous --}}
            @if ($allMovies->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 cursor-not-allowed">❮</span>
            @else
                <a href="{{ $allMovies->previousPageUrl() }}&category={{ $activeCategory }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">❮</a>
            @endif

            {{-- Angka Pagination (Dibuat sederhana) --}}
            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-600 text-white font-bold">{{ $allMovies->currentPage() }}</span>
            
            @if($allMovies->hasMorePages())
                <a href="{{ $allMovies->nextPageUrl() }}&category={{ $activeCategory }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">{{ $allMovies->currentPage() + 1 }}</a>
                <span class="w-10 h-10 flex items-center justify-center text-gray-500">...</span>
                <a href="?page={{ $allMovies->lastPage() }}&category={{ $activeCategory }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">{{ $allMovies->lastPage() }}</a>
            @endif

            {{-- Tombol Next --}}
            @if ($allMovies->hasMorePages())
                <a href="{{ $allMovies->nextPageUrl() }}&category={{ $activeCategory }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition">❯</a>
            @else
                <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 cursor-not-allowed">❯</span>
            @endif
        </div>
        @endif
    </section>

</div>
@endsection