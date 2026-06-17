@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-[100px] pb-20 bg-[#0f1115] flex justify-center items-start">
    <div class="max-w-3xl w-full px-6">
        
        <div class="mb-8">
            <a href="{{ route('profile.vip') }}" class="text-gray-500 hover:text-white text-sm flex items-center transition mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Pilihan Paket
            </a>
            <h1 class="text-3xl font-bold text-white">Ringkasan Pembayaran</h1>
        </div>

        <div class="bg-[#16181f] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl flex flex-col md:flex-row">
            
            <div class="p-8 md:w-1/2 bg-[#12141a] border-b md:border-b-0 md:border-r border-gray-800">
                <h3 class="text-gray-400 text-sm font-semibold tracking-wider mb-6">YANG ANDA DAPATKAN</h3>
                
                <ul class="space-y-5">
                    <li class="flex items-start">
                        <div class="bg-orange-500/10 text-orange-500 p-2 rounded-lg mr-4 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold text-sm">Akses Konten Premium</h4>
                            <p class="text-xs text-gray-500 mt-1">Buka semua film dan serial eksklusif.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-orange-500/10 text-orange-500 p-2 rounded-lg mr-4 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold text-sm">Bebas Iklan</h4>
                            <p class="text-xs text-gray-500 mt-1">Menonton tanpa jeda yang mengganggu.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="p-8 md:w-1/2 flex flex-col justify-between">
                <div>
                    <h3 class="text-gray-400 text-sm font-semibold tracking-wider mb-6">DETAIL TAGIHAN</h3>
                    
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-white font-bold text-lg">{{ $selectedPackage['name'] }}</span>
                        <span class="text-white font-bold">Rp {{ number_format($selectedPackage['price'], 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center mb-4 text-sm text-gray-500 border-b border-gray-800 pb-4">
                        <span>Pajak (0%)</span>
                        <span>Rp 0</span>
                    </div>
                    
                    <div class="flex justify-between items-center mb-8">
                        <span class="text-white font-bold">Total Pembayaran</span>
                        <span class="text-3xl font-extrabold text-orange-500">Rp {{ number_format($selectedPackage['price'], 0, ',', '.') }}</span>
                    </div>
                </div>

                <button id="pay-button" onclick="processPayment('{{ $selectedPackage['id'] }}')" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-orange-600/20 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Bayar Sekarang
                </button>
            </div>
            
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    function processPayment(packageType) {
        // Ubah tombol jadi status loading
        const btn = document.getElementById('pay-button');
        btn.innerHTML = "Memproses...";
        btn.disabled = true;

        fetch("{{ route('subscribe.process') }}", {
            method: "POST",
            headers: { 
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}" 
            },
            body: JSON.stringify({ package: packageType })
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) {
                throw new Error(data.message || data.error || "Gagal menghubungi server");
            }
            return data;
        })
        .then(data => {
            // Kembalikan tombol seperti semula
            btn.innerHTML = "Bayar Sekarang";
            btn.disabled = false;

            // KUNCI PERBAIKAN: Cek apakah server mengirim payment_url
            if (data.payment_url) {
                // Alihkan browser pengguna ke halaman QRIS Midtrans
                window.location.href = data.payment_url;
                
            } else if (data.snap_token) {
                // Cadangan jika server mengirim token pop-up
                window.snap.pay(data.snap_token);
                
            } else {
                alert("Kesalahan Sistem: URL pembayaran tidak ditemukan dari server.");
            }
        })
        .catch(err => {
            btn.innerHTML = "Bayar Sekarang";
            btn.disabled = false;
            console.error("Error Detail:", err);
            alert("Terjadi Kesalahan:\n" + err.message);
        });
    }
</script>
@endsection