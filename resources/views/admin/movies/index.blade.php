<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NONTONAJA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f1115] text-white font-sans antialiased overflow-x-hidden">
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
                <a href="{{ route('admin.movies.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-orange-500/10 text-orange-500 border-l-4 border-orange-500 rounded-r-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    <span class="font-bold">Daftar Film</span>
                </a>
            </div>
        </div>
        
        <div class="p-4 border-t border-gray-800">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/50 rounded-lg transition">
                <svg class="w-5 h-5 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span class="font-medium text-sm">Kembali ke Web</span>
            </a>
        </div>
    </aside>

    <main class="ml-64 w-[calc(100%-16rem)] min-h-screen flex flex-col">        
        <header class="h-20 bg-[#0f1115] border-b border-gray-800 flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="flex items-center">
                <button class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 bg-[#16181f] border border-gray-800 px-4 py-2 rounded-full cursor-pointer hover:border-gray-600 transition">
                    <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin' }}" class="w-8 h-8 rounded-full">
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-bold leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Super Admin</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </header>

        <div class="p-8 flex-1 overflow-y-auto">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Daftar Film</h1>
                    <p class="text-gray-400 text-sm">Kelola semua informasi film pada platform NONTON AJA</p>
                </div>
                    <a href="{{ route('admin.movies.create') }}" class="bg-[#ff6b00] hover:bg-[#e56000] text-white px-6 py-2.5 rounded-lg font-semibold flex items-center transition shadow-lg text-sm">
                    <span class="text-xl mr-2 leading-none">+</span> Tambah Film
                    </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                <div class="bg-[#16181f] border border-gray-800 rounded-xl p-6 flex items-center space-x-6">
                    <div class="bg-orange-500/10 p-4 rounded-xl text-orange-500 border border-orange-500/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium mb-1">Total Film</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($totalMovies, 0, ',', '.') }}</h3>
                        <p class="text-gray-500 text-xs mt-1">Semua film terdaftar di database</p>
                    </div>
                </div>

                <div class="bg-[#16181f] border border-gray-800 rounded-xl p-6 flex items-center space-x-6">
                    <div class="bg-purple-500/10 p-4 rounded-xl text-purple-500 border border-purple-500/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium mb-1">Film Aktif</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($activeMovies, 0, ',', '.') }}</h3>
                        <p class="text-gray-500 text-xs mt-1">Film yang memiliki tautan pemutaran</p>
                    </div>
                </div>

            </div>

            <div class="bg-[#16181f] border border-gray-800 rounded-t-xl p-6 flex flex-col lg:flex-row gap-4 items-center justify-between">
                <div class="relative w-full lg:w-96">
                <input type="text" id="searchInputAdmin" 
                    value="{{ request('search') }}" 
                    data-url="{{ route('admin.movies.index') }}" 
                    placeholder="Cari film berdasarkan judul..." 
                    class="w-full bg-[#0f1115] border border-gray-700 text-sm rounded-lg pl-4 pr-10 py-2.5 focus:outline-none focus:border-gray-500 text-white">                </div>
                
                <div class="flex space-x-4 w-full lg:w-auto">
                    <button class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition whitespace-nowrap flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Refresh
                    </button>
                </div>
            </div>

            <div class="bg-[#16181f] border-x border-b border-gray-800 rounded-b-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#0f1115] border-y border-gray-800 text-xs uppercase tracking-wider text-gray-400 font-semibold">
                            <th class="p-4 w-12 text-center"><input type="checkbox" class="rounded border-gray-600 bg-gray-700"></th>
                            <th class="p-4">Film</th>
                            <th class="p-4">Tahun</th>
                            <th class="p-4">Genre</th>
                            <th class="p-4">Rating</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4">Tanggal Ditambahkan</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="text-sm divide-y divide-gray-800/50">
                        
                        @forelse($movies as $movie)
                        <tr class="hover:bg-gray-800/20 transition">
                            <td class="p-4 text-center"><input type="checkbox" class="rounded border-gray-600 bg-transparent"></td>
                            
                            <td class="p-4">
                            <div class="flex items-center space-x-4 w-48 lg:w-72">
                                <img src="{{ $movie->thumbnail_url }}" class="w-10 h-14 object-cover rounded shadow-md border border-gray-700 shrink-0">
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-white font-bold text-sm whitespace-normal line-clamp-2 leading-snug">{{ $movie->title }}</h4>
                                    <p class="text-gray-500 text-xs mt-1 line-clamp-1">{{ $movie->category }}</p>
                                </div>
                            </div>
                            </td>
                            
                            <td class="p-4 text-gray-300">{{ $movie->year }}</td>
                            <td class="p-4 text-gray-300 max-w-[150px] truncate">{{ $movie->category }}</td>
                            
                            <td class="p-4 font-medium">
                                <span class="text-orange-500 mr-1">★</span> {{ number_format($movie->rating, 1) }}
                            </td>
                            
                            <td class="p-4 text-center">
                                @if($movie->stream && !empty($movie->stream->stream_url))
                                    <span class="bg-green-500/10 text-green-500 border border-green-500/20 px-2.5 py-1 rounded text-xs font-semibold">Aktif</span>
                                @else
                                    <span class="bg-red-500/10 text-red-500 border border-red-500/20 px-2.5 py-1 rounded text-xs font-semibold">Nonaktif</span>
                                @endif
                            </td>
                            
                            <td class="p-4 text-gray-400 text-xs">
                                {{ $movie->created_at->format('d M Y') }}<br>
                                <span class="text-gray-600">{{ $movie->created_at->format('H:i') }} WIB</span>
                            </td>
                            
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center space-x-2">                                        
                                    <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-gray-400 hover:text-white bg-gray-800 p-2 rounded transition border border-gray-700 hover:border-gray-500 inline-block">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>                                                                        
                                    <button type="button" 
                                    class="btn-delete-trigger text-gray-400 hover:text-red-500 bg-gray-800 p-2 rounded transition border border-gray-700 hover:border-red-500/50"
                                    data-form-id="delete-form-{{ $movie->id }}"
                                    data-title="{{ $movie->title }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>

                            <form id="delete-form-{{ $movie->id }}" action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-gray-500">
                                Belum ada data film di database.
                            </td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
                
                <div id="paginationContainer" class="p-4 border-t border-gray-800">
                        {{ $movies->links('pagination::tailwind') }} 
                </div>

            </div>

        </div>
    </main>

    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    
    <div class="bg-[#16181f] border border-gray-800 rounded-xl max-w-md w-full p-6 shadow-2xl scale-95 transform transition-transform duration-300">
        
        <div class="flex items-center space-x-4 mb-4">
            <div class="bg-red-500/10 text-red-500 p-3 rounded-full border border-red-500/20 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Hapus Film?</h3>
                <p class="text-gray-500 text-xs mt-0.5">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>

        <p class="text-gray-300 text-sm leading-relaxed mb-6">
            Apakah Anda yakin ingin menghapus film <span id="deleteModalMovieTitle" class="text-white font-bold"></span> secara permanen dari database?
        </p>

        <div class="flex items-center justify-end space-x-3 border-t border-gray-800/60 pt-4">
            <button type="button" id="btnCancelDelete" class="px-5 py-2.5 bg-transparent border border-gray-700 hover:border-gray-500 text-gray-300 hover:text-white rounded-lg text-xs font-semibold transition">
                Batal
            </button>
            <button type="button" id="btnConfirmDelete" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold transition shadow-lg shadow-red-600/20">
                Ya, Hapus Film
            </button>
        </div>
    </div>
</div>
<script src="{{ asset('script/admin_ajax.js') }}?v={{ time() }}"></script>
</body>
</html>
