@extends('layouts.app')

@section('content')
<div class="relative w-full h-[85vh] min-h-[600px] flex items-center pt-20">
    <div class="absolute inset-0 z-0">
        <img src="{{ $movie->banner_url }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0f1115] via-[#0f1115]/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0f1115] via-[#0f1115]/40 to-transparent"></div>
    </div>

    <div class="relative z-10 px-8 md:px-16 w-full max-w-4xl">
        <div class="text-gray-400 text-sm mb-6 flex items-center space-x-2">
            <a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a>
            <span>›</span>
            <span class="hover:text-white transition cursor-pointer">Film</span>
            <span>›</span>
            <span class="text-white">{{ $movie->title }}</span>
        </div>

        <div class="flex items-center space-x-4 mb-4 text-sm font-medium">
            <div class="bg-[#f5c518] text-black px-2 py-0.5 rounded font-bold text-xs flex items-center">
                TMDB <span class="ml-1.5 text-sm">{{ number_format($movie->rating, 1) }}</span>
            </div>
            <span class="text-gray-300">{{ $movie->year }}</span>
            <span class="text-gray-500 border border-gray-600 px-1.5 rounded text-xs">{{ $movie->age_rating }}</span>
        </div>

        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 tracking-tight">{{ $movie->title }}</h1>
        <p class="text-gray-300 text-base md:text-lg mb-8 line-clamp-3 leading-relaxed max-w-2xl">
            {{ $movie->description }}
        </p>

        <div class="flex items-center space-x-4">
            <a href="{{ route('movies.watch', $movie->id) }}" class="bg-[#ff6b00] hover:bg-[#e56000] text-white px-8 py-3.5 rounded-lg font-semibold flex items-center transition duration-300 shadow-[0_4px_14px_0_rgba(255,107,0,0.39)] w-max">
                <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Tonton Sekarang
            </a>
            @auth
                <form action="{{ route('watchlist.toggle', $movie->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-transparent border border-gray-500 hover:border-white hover:text-white text-gray-300 px-6 py-3.5 rounded-lg font-semibold flex items-center transition duration-300">
                        @if(Auth::user()->watchlists->contains($movie->id))
                            <svg class="w-5 h-5 mr-2 text-orange-500 fill-current" viewBox="0 0 20 20">
                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                            </svg>
                            <span class="text-white">in Watchlist</span>
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>Daftar Saya</span>
                        @endif
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-transparent border border-gray-500 hover:border-white hover:text-white text-gray-300 px-6 py-3.5 rounded-lg font-semibold flex items-center transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Daftar Saya</span>
                </a>
            @endauth

            <button class="bg-gray-800/80 hover:bg-gray-700 text-white p-3.5 rounded-full border border-gray-600 transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
            </button>
        </div>
    </div>
</div>

<div class="w-full border-b border-gray-800 bg-[#0f1115] px-8 md:px-16">
    <ul class="flex space-x-10 text-sm font-medium">
        <li id="nav-detail" onclick="switchTab('detail')" class="py-4 border-b-2 border-orange-500 text-white cursor-pointer transition">Detail</li>
        <li id="nav-ulasan" onclick="switchTab('ulasan')" class="py-4 border-b-2 border-transparent text-gray-400 hover:text-white cursor-pointer transition">Ulasan</li>
    </ul>
</div>

<div class="bg-[#0f1115] px-8 md:px-16 py-12 min-h-[50vh]">
    
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-8 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div id="tab-detail" class="block">
        <div class="flex flex-col lg:flex-row gap-12 mb-16">
            <div class="flex-1 flex flex-col md:flex-row gap-8">
                <img src="{{ $movie->thumbnail_url }}" alt="{{ $movie->title }}" class="w-64 h-auto rounded-xl shadow-2xl object-cover shrink-0 border border-gray-800">
                
                <div class="flex-1 py-2">
                    <table class="text-sm text-gray-300 w-full text-left border-collapse">
                        <tbody>
                            <tr class="border-b border-gray-800/50">
                                <td class="py-3 text-gray-500 font-medium w-32">Judul</td>
                                <td class="py-3 text-white">{{ $movie->title }}</td>
                            </tr>
                            <tr class="border-b border-gray-800/50">
                                <td class="py-3 text-gray-500 font-medium">Tahun Rilis</td>
                                <td class="py-3 text-white">{{ $movie->year }}</td>
                            </tr>
                            <tr class="border-b border-gray-800/50">
                                <td class="py-3 text-gray-500 font-medium">Genre</td>
                                <td class="py-3 text-white">{{ $movie->category }}</td>
                            </tr>
                            <tr class="border-b border-gray-800/50">
                                <td class="py-3 text-gray-500 font-medium">Batas Usia</td>
                                <td class="py-3 text-white">{{ $movie->age_rating }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-full lg:w-[350px] shrink-0">
                <div class="bg-[#16181f] border border-gray-800 rounded-2xl p-6 shadow-xl mb-6">
                    <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-800">
                        <span class="text-4xl text-[#f5c518]">★</span>
                        <div>
                            <div class="flex items-end">
                                <span class="text-3xl font-bold text-white leading-none">{{ number_format($movie->rating, 1) }}</span>
                                <span class="text-gray-500 text-sm ml-1 mb-1">/10</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">TMDB Rating</p>
                        </div>
                    </div>
                    
                    <ul class="space-y-1">
                        <li>
                            <button class="w-full flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 rounded-lg transition">
                                <svg class="w-5 h-5 mr-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                                Suka film ini
                            </button>
                        </li>
                        <li>
                            <button class="w-full flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 rounded-lg transition">
                                <svg class="w-5 h-5 mr-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                Tambahkan ke daftar
                            </button>
                        </li>
                        <li>
                            <button class="w-full flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gray-800 rounded-lg transition">
                                <svg class="w-5 h-5 mr-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                Bagikan
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mb-16 max-w-3xl">
            <h3 class="text-2xl font-bold text-white mb-4">Sinopsis</h3>
            <p class="text-gray-400 leading-relaxed">
                {{ $movie->description }}
            </p>
        </div>

        @if($relatedMovies->count() > 0)
        <div>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white">Lainnya Seperti Ini</h3>
                <a href="#" class="text-sm text-gray-400 hover:text-white flex items-center transition">
                    Lihat semua <span class="ml-1">→</span>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($relatedMovies as $related)
                    <a href="{{ route('movies.show', $related->id) }}" class="group relative rounded-xl overflow-hidden cursor-pointer transition transform hover:scale-105 hover:z-10 hover:shadow-2xl hover:shadow-orange-500/20 duration-300 block">
                        <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}" class="w-full aspect-[2/3] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-4">
                            <h4 class="text-white font-bold text-sm line-clamp-2">{{ $related->title }}</h4>
                            <div class="flex items-center text-xs text-gray-300 mt-1 space-x-2">
                                <span class="text-orange-500 font-bold">★ {{ number_format($related->rating, 1) }}</span>
                                <span>{{ $related->year }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div id="tab-ulasan" class="hidden">
        <div class="max-w-4xl">
            <h2 class="text-2xl font-bold text-white mb-8">Ulasan</h2>
            
            <div class="bg-[#16181f] border border-gray-800 rounded-2xl p-6 md:p-8 mb-12 shadow-xl">
                <h3 class="text-white font-bold mb-1">Tulis ulasan Anda</h3>
                <p class="text-gray-400 text-sm mb-6">Bagikan pendapat Anda tentang film ini</p>

                @auth
                    <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                        @csrf
                        <div class="relative mb-4">
                            <textarea name="comment" rows="4" class="w-full bg-[#0f1115] border border-gray-700 rounded-xl p-4 text-white focus:outline-none focus:border-orange-500 resize-none transition" placeholder="Apa yang Anda pikirkan tentang film ini?" required></textarea>
                            <span class="absolute bottom-4 right-4 text-xs text-gray-500">0/500</span>
                        </div>
                        <button type="submit" class="w-full md:w-auto px-8 bg-[#ff6b00] hover:bg-[#e56000] text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-[0_4px_14px_0_rgba(255,107,0,0.39)]">
                            Kirim Ulasan
                        </button>
                    </form>
                @else
                    <div class="bg-[#0f1115] border border-gray-700 rounded-xl p-8 text-center">
                        <p class="text-gray-400 mb-4">Anda harus masuk menggunakan akun Google untuk dapat menulis ulasan.</p>
                        <a href="{{ route('login') }}" class="inline-block bg-[#ff6b00] hover:bg-[#e56000] text-white font-semibold py-2.5 px-8 rounded-lg transition shadow-lg">Masuk / Sign In</a>
                    </div>
                @endauth
            </div>

            <div class="space-y-8">
                @forelse($movie->reviews()->latest()->get() ?? [] as $review)
                    <div class="flex space-x-4 border-b border-gray-800/60 pb-8">
                        <img src="{{ $review->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->user->username) . '&background=random' }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover border border-gray-700 shrink-0">
                        
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    <h4 class="text-white font-bold">{{ $review->user->name }}</h4>
                                    <span class="text-gray-500 text-xs">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <button class="text-gray-500 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                                </button>
                            </div>
                            <p class="text-gray-300 text-sm leading-relaxed mb-3">
                                {{ $review->comment }}
                            </p>
                            <div class="flex items-center space-x-6 text-xs text-gray-500 font-medium">
                                <button class="flex items-center space-x-1.5 hover:text-orange-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                                    <span>Suka</span>
                                </button>
                                <button class="flex items-center space-x-1.5 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                    <span>Balas</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 border border-dashed border-gray-800 rounded-2xl">
                        <p class="text-gray-500">Belum ada ulasan untuk film ini. Jadilah yang pertama memberikan ulasan!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<script>
    function switchTab(tabId) {
        // Sembunyikan semua tab konten
        document.getElementById('tab-detail').classList.add('hidden');
        document.getElementById('tab-detail').classList.remove('block');
        document.getElementById('tab-ulasan').classList.add('hidden');
        document.getElementById('tab-ulasan').classList.remove('block');
        
        // Reset warna tulisan navigasi
        document.getElementById('nav-detail').className = "py-4 border-b-2 border-transparent text-gray-400 hover:text-white cursor-pointer transition";
        document.getElementById('nav-ulasan').className = "py-4 border-b-2 border-transparent text-gray-400 hover:text-white cursor-pointer transition";

        // Tampilkan tab yang diklik dan beri garis bawah oranye
        document.getElementById('tab-' + tabId).classList.remove('hidden');
        document.getElementById('tab-' + tabId).classList.add('block');
        document.getElementById('nav-' + tabId).className = "py-4 border-b-2 border-orange-500 text-white cursor-pointer transition";
    }
</script>
@endsection