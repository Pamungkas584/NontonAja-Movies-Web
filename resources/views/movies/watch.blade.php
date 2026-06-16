@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0f1115] pt-24 pb-12">
    
    <div class="px-8 md:px-16 pb-6 flex items-center justify-between">
        <a href="{{ route('movies.show', $movie->id) }}" class="text-gray-400 hover:text-white flex items-center transition group text-sm font-medium">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Detail
        </a>
        <div class="text-gray-300 font-semibold">{{ $movie->title }} ({{ $movie->year }})</div>
        <div class="w-24"></div> </div>

    <div class="w-full bg-black flex justify-center border-y border-gray-800 shadow-2xl relative">
        <div class="w-full max-w-[1400px] aspect-video relative bg-[#16181f]">
            
            @if($movie->stream && !empty($movie->stream->stream_url))
                <iframe src="{{ $movie->stream->stream_url }}" class="absolute top-0 left-0 w-full h-full" frameborder="0" allowfullscreen></iframe>
                @else
                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-[#0a0c0f] text-center px-4">
                        <span class="bg-gray-800/50 p-4 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </span>
                                <h3 class="text-white text-xl font-bold mb-2">Video Belum Tersedia</h3>
                                <p class="text-gray-500 text-sm max-w-md">
                                    Tautan pemutaran untuk film ini belum ditambahkan ke dalam server kami. Silakan periksa kembali nanti.
                                </p>
                    </div>
            @endif

        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-8 md:px-16 mt-8 flex flex-col md:flex-row justify-between items-start gap-8">
        
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-white mb-4">{{ $movie->title }}</h1>
            
            <div class="flex items-center space-x-4 text-sm text-gray-400 mb-6 font-medium">
                <span class="bg-[#f5c518] text-black px-1.5 py-0.5 rounded font-bold text-xs">IMDb {{ number_format($movie->rating, 1) }}</span>
                <span>{{ $movie->year }}</span>
                <span class="border border-gray-600 px-1.5 py-0.5 rounded text-xs">{{ $movie->age_rating }}</span>
                <span class="border border-gray-600 px-1.5 py-0.5 rounded text-xs tracking-wider">HD</span>
            </div>
            
            <p class="text-gray-400 leading-relaxed max-w-3xl text-sm md:text-base">
                {{ $movie->description }}
            </p>
        </div>

        <div class="flex items-center space-x-3 shrink-0 pt-2">
            
            @auth
            <form action="{{ route('watchlist.toggle', $movie->id) }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-2 bg-transparent border border-gray-600 hover:border-gray-400 text-white px-4 py-2.5 rounded-lg transition text-sm font-medium">
                    @if(Auth::user()->watchlists->contains($movie->id))
                        <svg class="w-4 h-4 text-orange-500 fill-current" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                        <span>Di Daftar Saya</span>
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span>Daftar Saya</span>
                    @endif
                </button>
            </form>
            @endauth

            <button class="flex items-center space-x-2 bg-transparent border border-gray-600 hover:border-gray-400 text-white px-4 py-2.5 rounded-lg transition text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                <span>Suka</span>
            </button>
            
            <button class="flex items-center space-x-2 bg-transparent border border-gray-600 hover:border-gray-400 text-white px-4 py-2.5 rounded-lg transition text-sm font-medium">
                <svg class="w-4 h-4 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                <span>Tidak Suka</span>
            </button>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-8 md:px-16 mt-16 border-t border-gray-800/80 pt-10">
        <h3 class="text-xl font-bold text-white mb-6">Tayangan Terkait</h3>
        <div class="flex space-x-4">
            <div class="w-64 relative group cursor-pointer">
                <div class="aspect-video bg-gray-800 rounded-lg overflow-hidden border border-gray-700 relative">
                    <img src="{{ $movie->banner_url }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 transition duration-300">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="bg-black/60 rounded-full p-2.5 backdrop-blur-sm border border-gray-600">
                            <svg class="w-6 h-6 text-white fill-current ml-1" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gray-700">
                        <div class="h-full bg-orange-600 w-1/3"></div>
                    </div>
                </div>
                <h4 class="text-white text-sm font-medium mt-3">{{ $movie->title }}</h4>
                <p class="text-gray-500 text-xs mt-1">Selesai Menonton • Tinggalkan Ulasan</p>
            </div>
        </div>
    </div>

</div>
@endsection