<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($movie) ? 'Edit Film' : 'Tambah Film' }} - Admin NONTONAJA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f1115] text-white font-sans antialiased overflow-x-hidden flex">

    <aside class="w-64 bg-[#16181f] border-r border-gray-800 h-screen fixed top-0 left-0 flex flex-col z-50">
        <div class="h-20 flex items-center px-8 border-b border-gray-800 shrink-0">
            <div class="text-2xl font-bold tracking-tighter text-white">
                NONTON<span class="text-orange-500">AJA</span>
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto py-6 flex flex-col gap-2 px-4">
            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <div class="mt-2">
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Film</p>
                <a href="{{ route('admin.movies.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    <span class="font-medium">Daftar Film</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-orange-500/10 text-orange-500 border-l-4 border-orange-500 rounded-r-lg transition mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span class="font-bold">{{ isset($movie) ? 'Edit Film' : 'Tambah Film' }}</span>
                </a>
            </div>
        </div>
        
        <div class="p-4 border-t border-gray-800 shrink-0">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                <svg class="w-5 h-5 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span class="font-medium text-sm">Kembali ke Web</span>
            </a>
        </div>
    </aside>

    <main class="ml-64 flex-1 min-h-screen flex flex-col pb-12">
        
        <header class="h-20 bg-[#0f1115] border-b border-gray-800 flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="flex items-center">
                <button class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 bg-[#16181f] border border-gray-800 px-4 py-2 rounded-full">
                    <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin' }}" class="w-8 h-8 rounded-full">
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-bold leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Super Admin</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8 flex-1 max-w-5xl">
            
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">{{ isset($movie) ? 'Edit Film' : 'Tambah Film' }}</h1>
                <div class="text-gray-400 text-sm flex items-center space-x-2">
                    <span>Dashboard</span> <span class="text-gray-600">›</span>
                    <span>Film</span> <span class="text-gray-600">›</span>
                    <span class="text-white">{{ isset($movie) ? 'Edit Film' : 'Tambah Film' }}</span>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-[#16181f] border border-gray-800 rounded-xl p-8 shadow-xl">
                <div class="mb-8 border-b border-gray-800 pb-4">
                    <h2 class="text-lg font-bold text-white">Informasi Film</h2>
                    <p class="text-gray-400 text-sm">Lengkapi informasi film di bawah ini.</p>
                </div>

                <form action="{{ isset($movie) ? route('admin.movies.update', $movie->id) : route('admin.movies.store') }}" method="POST">
                    @csrf
                    @if(isset($movie))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Judul Film <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $movie->title ?? '') }}" placeholder="Masukkan judul film" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Tahun Rilis <span class="text-red-500">*</span></label>
                            <input type="text" name="year" value="{{ old('year', $movie->year ?? '') }}" placeholder="Contoh: 2024" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Link Poster Film <span class="text-red-500">*</span></label>
                            <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url', $movie->thumbnail_url ?? '') }}" placeholder="https://example.com/poster.jpg" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition" required>
                            <p class="text-xs text-gray-500 mt-2">Masukkan URL link poster film (disarankan ukuran 600x900)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Genre <span class="text-red-500">*</span></label>
                            <select name="category" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition appearance-none" required>
                                <option value="" disabled {{ !isset($movie) ? 'selected' : '' }}>Pilih genre</option>
                                @php $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi', 'Thriller', 'Animation', 'Fantasy', 'Romance']; @endphp
                                @foreach($genres as $g)
                                    <option value="{{ $g }}" {{ (old('category', $movie->category ?? '') == $g) ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-2">Pilih kategori utama genre film</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Batas Usia <span class="text-red-500">*</span></label>
                            <select name="age_rating" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition appearance-none" required>
                                <option value="" disabled {{ !isset($movie) ? 'selected' : '' }}>Pilih batas usia</option>
                                @php $ages = ['SU', '13+', '17+', '18+', '21+']; @endphp
                                @foreach($ages as $a)
                                    <option value="{{ $a }}" {{ (old('age_rating', $movie->age_rating ?? '') == $a) ? 'selected' : '' }}>{{ $a }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-2">Pilih batas usia yang sesuai</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Durasi (Menit)</label>
                            <input type="number" placeholder="Contoh: 120" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition">
                            <p class="text-xs text-gray-500 mt-2">Masukkan durasi film dalam menit (opsional)</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-300 mb-2">Sinopsis <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5" placeholder="Tulis sinopsis film di sini..." class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition resize-none" required>{{ old('description', $movie->description ?? '') }}</textarea>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500">Berikan sinopsis atau deskripsi singkat tentang film</p>
                            <p class="text-xs text-gray-500">Maks 1000 karakter</p>
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-sm font-bold text-gray-300 mb-2">Link Pemutaran</label>
                        <input type="url" name="stream_url" value="{{ old('stream_url', $movie->stream->stream_url ?? '') }}" placeholder="https://example.com/watch/film-id" class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:border-orange-500 text-white text-sm transition">
                        <p class="text-xs text-gray-500 mt-2">Masukkan URL link embed untuk pemutaran film (streaming)</p>
                    </div>

                    <div class="flex items-center justify-end space-x-4 border-t border-gray-800 pt-6">
                        <a href="{{ route('admin.movies.index') }}" class="px-6 py-2.5 bg-transparent border border-gray-600 hover:border-gray-400 text-white rounded-lg text-sm font-semibold transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-[#ff6b00] hover:bg-[#e56000] text-white rounded-lg text-sm font-semibold transition flex items-center shadow-lg shadow-orange-500/20">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            {{ isset($movie) ? 'Simpan Perubahan' : 'Simpan Film' }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 bg-[#0f1115] border border-blue-900/50 rounded-xl p-4 flex items-start space-x-3">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <h4 class="text-sm font-bold text-white mb-1">Informasi</h4>
                    <p class="text-xs text-gray-400 leading-relaxed">Pastikan semua informasi yang dimasukkan sudah benar. Film yang ditambahkan akan langsung tersedia di platform.</p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>