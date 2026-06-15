@extends('layouts.app')

@section('content')
    <div class="relative w-full h-[85vh] overflow-hidden bg-black group">
        @forelse($heroMovies as $index => $hero)
        <div class="carousel-item absolute inset-0 {{ $index == 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
            <img src="{{ $hero->banner_url ?? 'https://via.placeholder.com/1920x1080' }}" draggable="false" alt="Banner" class="w-full h-full object-cover object-top opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0f1115] via-transparent to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0f1115] via-[#0f1115]/80 to-transparent w-2/3"></div>

            <div class="absolute inset-y-0 left-0 flex flex-col justify-center px-12 md:px-24 w-full md:w-1/2 z-20">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">{{ $hero->title }}</h1>
                <div class="flex items-center space-x-4 text-sm mb-6 text-gray-300 font-semibold">
                    <span class="bg-yellow-500 text-black px-1.5 rounded font-bold">IMDb</span>
                    <span>{{ number_format($hero->rating, 1) }}</span>
                    <span class="border border-gray-500 px-1.5 rounded text-xs">HD</span>
                    <span>{{ $hero->year }}</span>
                    <span>{{ $hero->age_rating }}</span>
                </div>
                <p class="text-gray-300 mb-8 leading-relaxed line-clamp-3">
                    {{ $hero->description }}
                </p>
                <div class="flex space-x-4">
                    <a href="{{ route('movies.show', $hero->id) }}" class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2.5 px-8 rounded flex items-center space-x-2 transition inline-flex w-max">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        <span>Tonton Sekarang</span>
                    </a>
                    <button class="bg-transparent border border-gray-500 hover:bg-gray-800 hover:border-gray-400 text-white font-medium py-2.5 px-8 rounded transition">
                        + Daftar Saya
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="absolute inset-0 flex items-center justify-center text-gray-500 z-10">Data Hero belum ada.</div>
        @endforelse

        <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 p-4 rounded-full z-30 hover:bg-orange-600 transition hidden group-hover:block">❮</button>
        <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 p-4 rounded-full z-30 hover:bg-orange-600 transition hidden group-hover:block">❯</button>
    </div>

    <div class="relative z-20 -mt-10 px-8 pb-12 space-y-12">
        
        <section>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl md:text-2xl font-bold">Drama</h2>
                <a href="#" class="text-sm text-gray-400 hover:text-white transition">Lihat semua →</a>
            </div>
            <div class="drag-scroll flex space-x-4 overflow-x-auto hide-scrollbar pb-4 snap-x cursor-grab">
                @forelse($dramaMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="min-w-[250px] w-[250px] md:min-w-[280px] md:w-[280px] flex-none snap-start group relative block rounded-lg overflow-hidden cursor-pointer select-none">
                    <img src="{{ $movie->thumbnail_url ?? 'https://via.placeholder.com/300x169' }}" draggable="false" alt="{{ $movie->title }}" class="w-full aspect-video object-cover transition transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center pointer-events-none">
                        <span class="text-white text-2xl border-2 border-white rounded-full w-12 h-12 flex items-center justify-center pl-1 backdrop-blur-sm">
                            <svg class="w-5 h-5 fill-current ml-1" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </div>
                </a>
                @empty
                <p class="text-gray-500 text-sm">Belum ada data drama di database.</p>
                @endforelse
            </div>
        </section>

        <section>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl md:text-2xl font-bold">Action</h2>
                <a href="#" class="text-sm text-gray-400 hover:text-white transition">Lihat semua →</a>
            </div>
            <div class="drag-scroll flex space-x-4 overflow-x-auto hide-scrollbar pb-4 snap-x cursor-grab relative">
                @forelse($actionMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="min-w-[250px] w-[250px] md:min-w-[280px] md:w-[280px] flex-none snap-start group relative block rounded-lg overflow-hidden cursor-pointer select-none">
                    <img src="{{ $movie->thumbnail_url ?? 'https://via.placeholder.com/300x169' }}" draggable="false" alt="{{ $movie->title }}" class="w-full aspect-video object-cover transition transform group-hover:scale-105 duration-500">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center pointer-events-none">
                        <span class="text-white text-2xl border-2 border-white rounded-full w-12 h-12 flex items-center justify-center pl-1 backdrop-blur-sm">
                            <svg class="w-5 h-5 fill-current ml-1" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </div>
                </a>
                @empty
                <p class="text-gray-500 text-sm">Belum ada data action di database.</p>
                @endforelse
                
                <div class="absolute right-0 top-0 bottom-4 w-12 bg-gradient-to-l from-[#0f1115] to-transparent flex items-center justify-end pointer-events-none">
                    <span class="text-white font-bold pr-2 text-xl">❯</span>
                </div>
            </div>
        </section>

        <section class="pt-4">
            <h2 class="text-xl md:text-2xl font-bold mb-6">Genre</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $genres = [
                        ['name' => 'Action', 'icon' => ''],
                        ['name' => 'Comedy', 'icon' => ''],
                        ['name' => 'Horror', 'icon' => ''],
                        ['name' => 'Fantasy', 'icon' => ''],
                        ['name' => 'Thriller', 'icon' => ''],
                        ['name' => 'Adventure', 'icon' => ''],
                        ['name' => 'Drama', 'icon' => ''],
                        ['name' => 'Sci-Fi', 'icon' => ''],
                        ['name' => 'Mystery', 'icon' => ''],
                        ['name' => 'Romance', 'icon' => ''],
                    ];
                @endphp

                @foreach($genres as $genre)
                <a href="#" class="flex items-center space-x-3 bg-transparent border border-gray-800 hover:border-gray-500 hover:bg-gray-800/50 rounded-lg px-6 py-4 transition duration-300 group">
                    <span class="text-orange-500 text-xl filter drop-shadow-md">{{ $genre['icon'] }}</span>
                    <span class="text-gray-200 font-medium group-hover:text-white">{{ $genre['name'] }}</span>
                </a>
                @endforeach
            </div>
        </section>

    </div>

@endsection