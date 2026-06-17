<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;


class SubscriptionController extends Controller
{
    public function __construct()
    {
        // Sekarang kita memanggil dari config, bukan env() langsung
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // 1. Fungsi menampilkan halaman Ringkasan (Checkout)
    public function checkoutPage($package)
    {
        $packages = [
            '1_bulan' => ['id' => '1_bulan', 'name' => 'VIP 1 Bulan', 'price' => 60000],
            '3_bulan' => ['id' => '3_bulan', 'name' => 'VIP 3 Bulan', 'price' => 150000],
            '1_tahun' => ['id' => '1_tahun', 'name' => 'VIP 1 Tahun', 'price' => 600000],
        ];

        // Jika user mengubah URL secara manual ke paket yang tidak ada, kembalikan ke profil
        if (!array_key_exists($package, $packages)) {
            return redirect()->route('profile.vip');
        }

        $selectedPackage = $packages[$package];
        return view('subscribe.checkout', compact('selectedPackage'));
    }

    // 2. Fungsi memproses data ke Midtrans (Ganti nama fungsi dari 'checkout' menjadi 'processPayment')
    public function processPayment(Request $request)
    {
        $request->validate([
            'package' => 'required|in:1_bulan,3_bulan,1_tahun'
        ]);

        $packages = [
            '1_bulan' => ['name' => 'VIP 1 Bulan', 'price' => 60000],
            '3_bulan' => ['name' => 'VIP 3 Bulan', 'price' => 150000],
            '1_tahun' => ['name' => 'VIP 1 Tahun', 'price' => 600000],
        ];

        $selectedPackage = $packages[$request->package];
        $orderId = 'NONTONAJA-' . time() . '-' . Auth::id();

        // Catat di database
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'order_id' => $orderId,
            'package_name' => $selectedPackage['name'],
            'amount' => $selectedPackage['price'],
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $selectedPackage['price'],
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            
            'enabled_payments' => ['qris', 'gopay'], 
            'callbacks' => [
                'finish' => url('/profile/vip')]
        ];

        try {
            $paymentUrl = Snap::createTransaction($params)->redirect_url;
            $transaction->update(['snap_token' => $paymentUrl]);
            return response()->json(['payment_url' => $paymentUrl]); 

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 3. Fungsi untuk menerima laporan dari Midtrans (Webhook)
    public function notificationHandler(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        
        // Validasi keamanan dari Midtrans
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        // Cari data transaksi di database
        $transaction = Transaction::where('order_id', $request->order_id)->first();
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update status transaksi dan aktifkan VIP user
        $status = $request->transaction_status;

        if ($status == 'settlement' || $status == 'capture') {
            $transaction->update(['status' => 'success']);

            // Berikan masa aktif VIP ke pengguna
            $user = User::find($transaction->user_id);
            
            if($user) {
                $days = 30; // Default 1 bulan
                if (str_contains($transaction->package_name, '3 Bulan')) $days = 90;
                if (str_contains($transaction->package_name, '1 Tahun')) $days = 365;

                // Jika user masih punya VIP, akumulasikan waktunya
                $baseDate = ($user->vip_until && Carbon::parse($user->vip_until)->isFuture()) 
                            ? Carbon::parse($user->vip_until) 
                            : Carbon::now();

                $user->update([
                    'vip_until' => $baseDate->addDays($days)
                ]);
            }

        } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
            $transaction->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Notification handled successfully']);
    }
}