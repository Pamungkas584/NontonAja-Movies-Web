@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0f1115] pt-28 px-8 md:px-16 pb-20">
    
    <div class="mb-10 border-b border-gray-800 pb-6">
        <h1 class="text-3xl font-bold text-white mb-2">Hasil Pencarian TMDB</h1>
        <p class="text-gray-400">Pencarian global untuk: <span class="text-white font-bold">"{{ $query }}"</span></p>
    </div>

    @if(count($tmdbMovies) > 0)
        <!-- Ganti Grid menjadi List menurun (Flex Column) -->
        <div class="flex flex-col space-y-6 max-w-5xl mx-auto">
            @foreach($tmdbMovies as $movie)
                @if(!empty($movie['poster_path']))
                    
                    <!-- Link Card: Mengarah ke route Import -->
                    <a href="{{ route('movies.import', $movie['id']) }}" class="group flex flex-col md:flex-row bg-[#16181f] border border-gray-800 hover:border-orange-500 rounded-xl overflow-hidden transition duration-300 shadow-lg cursor-pointer">
                        
                        <!-- Gambar Poster (Kiri) -->
                        <div class="w-full md:w-48 shrink-0 relative bg-black aspect-[2/3] md:aspect-auto">
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        
                        <!-- Informasi Teks (Kanan) -->
                        <div class="p-6 flex flex-col justify-center flex-1">
                            <h3 class="text-2xl font-bold text-white group-hover:text-orange-500 transition mb-3">{{ $movie['title'] }}</h3>
                            
                            <!-- Rating & Tahun Rilis -->
                            <div class="flex items-center space-x-4 text-sm text-gray-400 mb-4 font-medium">
                                <span class="bg-[#f5c518] text-black px-2 py-0.5 rounded font-bold text-xs flex items-center">
                                    ★ {{ number_format($movie['vote_average'], 1) }}
                                </span>
                                <span class="border border-gray-600 px-2 py-0.5 rounded text-xs">
                                    {{ !empty($movie['release_date']) ? substr($movie['release_date'], 0, 4) : 'Tahun Tidak Diketahui' }}
                                </span>
                            </div>

                            <!-- Sinopsis Singkat -->
                            <p class="text-gray-400 text-sm md:text-base leading-relaxed line-clamp-3">
                                {{ !empty($movie['overview']) ? $movie['overview'] : 'Sinopsis belum tersedia untuk film ini.' }}
                            </p>
                            
                            <!-- Tombol Tambahkan Virtual -->
                            <div class="mt-6 flex items-center text-orange-500 text-sm font-semibold group-hover:translate-x-2 transition transform">
                                Tonton <span class="ml-2">→</span>
                            </div>
                        </div>
                    </a>

                @endif
            @endforeach
        </div>
    @else
        <div class="py-20 text-center border border-dashed border-gray-800 rounded-2xl bg-[#16181f]/30 max-w-3xl mx-auto">
            <h3 class="text-white font-semibold text-lg mb-1">Pencarian Tidak Ditemukan</h3>
            <p class="text-gray-500 text-sm">Tidak ada film yang cocok dengan kata kunci "{{ $query }}" di server TMDB.</p>
        </div>
    @endif

</div>
@endsection