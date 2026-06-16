@extends('layouts.app')

@section('content')
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<div class="min-h-screen bg-[#0f1115] pt-24 px-8 md:px-16 pb-20">
    
    <div class="text-gray-400 text-sm mb-6 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a>
        <span>›</span>
        <a href="{{ route('movies.index') }}" class="hover:text-white transition">Film</a>
        <span>›</span>
        <span class="text-white">{{ $categoryName }}</span>
    </div>

    <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-12 space-y-6 lg:space-y-0">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $categoryName }}</h1>
            <p class="text-gray-400 text-base leading-relaxed mb-4">
                {{ $description }}
            </p>
            <p class="text-gray-500 text-sm">{{ number_format($totalMovies, 0, ',', '.') }} judul</p>
        </div>
        
        <div class="flex items-center space-x-4">
            <span class="text-gray-400 text-sm">Urutkan:</span>
            <button class="flex items-center justify-between w-40 bg-[#16181f] border border-gray-700 hover:border-gray-500 text-white px-4 py-2.5 rounded-lg transition text-sm">
                <span>Populer</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
        </div>
    </div>

    @if($popularMovies->count() > 0)
    <section class="mb-16">
        <h2 class="text-2xl font-bold text-white mb-6">Film Populer</h2>
        
        <div class="flex space-x-4 overflow-x-auto hide-scrollbar snap-x pb-4">
            @foreach($popularMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="min-w-[160px] md:min-w-[220px] snap-start group cursor-pointer block">
                    <div class="relative rounded-xl overflow-hidden mb-3 aspect-[2/3] bg-gray-800">
                        <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition transform group-hover:scale-105 duration-300">
                        <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded flex items-center shadow-lg">
                            <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                        </div>
                    </div>
                    <h3 class="text-white font-bold text-sm md:text-base line-clamp-1 group-hover:text-orange-500 transition">{{ $movie->title }}</h3>
                    <p class="text-gray-400 text-xs md:text-sm mt-1">{{ $movie->year }} • {{ $movie->category }}</p>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <section>
        <h2 class="text-2xl font-bold text-white mb-6">Semua Film {{ $categoryName }}</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-x-4 gap-y-10 mb-12">
            @forelse($allMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="group cursor-pointer block">
                    <div class="relative rounded-xl overflow-hidden mb-3 aspect-[2/3] bg-gray-800">
                        <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition transform group-hover:scale-105 duration-300">
                        <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded flex items-center shadow-lg">
                            <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                        </div>
                    </div>
                    <h3 class="text-white font-bold text-sm md:text-base line-clamp-1 group-hover:text-orange-500 transition">{{ $movie->title }}</h3>
                    <p class="text-gray-400 text-xs md:text-sm mt-1">{{ $movie->year }} • {{ $movie->category }}</p>
                </a>
            @empty
                <div class="col-span-full py-16 text-center border border-dashed border-gray-800 rounded-2xl">
                    <p class="text-gray-500">Koleksi film untuk kategori ini belum tersedia.</p>
                </div>
            @endforelse
        </div>

        @if($allMovies->hasPages())
        <div class="flex items-center justify-center space-x-2 mt-8">
            @if ($allMovies->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 cursor-not-allowed">❮</span>
            @else
                <a href="{{ $allMovies->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">❮</a>
            @endif

            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-600 text-white font-bold">{{ $allMovies->currentPage() }}</span>
            
            @if($allMovies->hasMorePages())
                <a href="{{ $allMovies->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">{{ $allMovies->currentPage() + 1 }}</a>
                <span class="w-10 h-10 flex items-center justify-center text-gray-500">...</span>
                <a href="?page={{ $allMovies->lastPage() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">{{ $allMovies->lastPage() }}</a>
            @endif

            @if ($allMovies->hasMorePages())
                <a href="{{ $allMovies->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-[#16181f] border border-transparent hover:border-gray-700 hover:text-white transition">❯</a>
            @else
                <span class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 cursor-not-allowed">❯</span>
            @endif
        </div>
        @endif
    </section>

</div>
@endsection