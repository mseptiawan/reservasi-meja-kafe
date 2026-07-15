<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Menampilkan daftar reservasi milik pelanggan yang berstatus 'approved'
     * tetapi BELUM memiliki data payment (belum dibayar).
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        // Ambil status tab dari URL, default adalah 'pending' (Permintaan Aktif)
        $status = $request->get('status', 'pending');

        // 1. Hitung Statistik untuk Card Komponen Pelanggan
        // Tagihan Aktif: Reservasi 'approved' yang belum dibayar sama sekali
        $pendingCount = Reservation::where('user_id', $userId)->where('status', 'approved')->whereDoesntHave('payment')->count();

        // Riwayat Sukses: Pembayaran user yang sudah di-acc admin
        $successCount = Payment::whereHas('reservation', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'success')
            ->count();

        // Riwayat Ditolak: Pembayaran user yang ditolak admin
        $failedCount = Payment::whereHas('reservation', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'failed')
            ->count();

        $stats = [
            'total' => $pendingCount + $successCount + $failedCount,
            'pending' => $pendingCount,
            'success' => $successCount,
            'failed' => $failedCount,
        ];

        // 2. Ambil Data Berdasarkan Tab Aktif
        $displayData = [];
        if ($status === 'pending') {
            // Ambil data Reservasi yang perlu dibayar
            $displayData = Reservation::with('table')->where('user_id', $userId)->where('status', 'approved')->whereDoesntHave('payment')->orderBy('reservation_date', 'asc')->get();
        } else {
            // Ambil data dari tabel Payments untuk riwayat (Success & Failed)
            $displayData = Payment::with(['reservation.table'])
                ->whereHas('reservation', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })
                ->whereIn('status', ['success', 'failed'])
                ->latest()
                ->get();
        }

        return view('pelanggan.payment.index', compact('displayData', 'status', 'stats'));
    }

    /**
     * Halaman detail reservasi beserta instruksi pembayaran & Form Upload
     */
    public function create($reservation_id)
    {
        // Pastikan reservasi ini benar milik user bersangkutan dan statusnya approved
        $reservation = Reservation::with('table')->where('user_id', Auth::id())->where('status', 'approved')->findOrFail($reservation_id);

        // Data statis untuk rekening bank / VA
        $bankInstructions = [['name' => 'Bank BCA (Manual Transfer)', 'number' => '8015-2234-99', 'holder' => 'Senja Space Cafe'], ['name' => 'Mandiri Virtual Account', 'number' => '8803-0821-xxxx-xxxx', 'holder' => 'Senja Space - ' . Auth::user()->name]];

        // Hitung total biaya (Contoh: Kapasitas meja x Rp 25.000 sebagai tanda jadi / down payment)
        // Sesuaikan sendiri formulasi biaya Senja Space di sini
        $amountToPay = $reservation->table->capacity * 25000;

        return view('pelanggan.payment.create', compact('reservation', 'bankInstructions', 'amountToPay'));
    }

    /**
     * Memproses upload berkas bukti pembayaran
     */
    public function store(Request $request, $reservation_id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->where('status', 'approved')->findOrFail($reservation_id);

        $request->validate(
            [
                'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'amount' => 'required|numeric',
            ],
            [
                'proof_of_payment.required' => 'Wajib mengunggah berkas bukti transfer.',
                'proof_of_payment.image' => 'Berkas harus berupa gambar foto/screenshot.',
                'proof_of_payment.max' => 'Ukuran gambar maksimal adalah 2 Megabytes.',
            ],
        );

        // Proses simpan file ke direktori storage/app/public/proofs
        $filePath = $request->file('proof_of_payment')->store('proofs', 'public');

        // Generate Kode Transaksi Unik Pembayaran
        $paymentCode = 'PAY-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));

        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_code' => $paymentCode,
            'amount' => $request->amount,
            'proof_of_payment' => $filePath,
            'status' => 'pending', // Menunggu persetujuan administrasi dari admin
        ]);

        return redirect()->route('reservasi.history')->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi keuangan dari admin.');
    }
    public function adminIndex(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        // 1. Ambil status dari URL, default-nya 'pending'
        $status = $request->get('status', 'pending');

        // 2. Hitung statistik riwayat pembayaran (untuk Stat Cards)
        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'success' => Payment::where('status', 'success')->count(),
            'failed' => Payment::where('status', 'failed')->count(),
        ];

        // 3. Filter data berdasarkan Tab yang dipilih
        $payments = Payment::with(['reservation.user', 'reservation.table'])
            ->when($status === 'pending', function ($query) {
                // Permintaan Aktif yang harus segera di-verifikasi
                return $query->where('status', 'pending');
            })
            ->when($status === 'history', function ($query) {
                // Riwayat pembayaran yang sudah sukses ataupun gagal/ditolak
                return $query->whereIn('status', ['success', 'failed']);
            })
            ->latest()
            ->get(); // Jika data sangat banyak, kamu bisa ganti ->paginate(10);

        return view('admin.payments.index', compact('payments', 'status', 'stats'));
    }

    /**
     * Aksi Admin menyetujui / menolak pembayaran
     */
    public function adminVerify(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $payment = Payment::with('reservation')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:success,failed',
            'admin_note' => 'nullable|string|max:255',
        ]);

        $payment->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        if ($request->status === 'success') {
            $payment->reservation->update(['status' => 'approved']);
        } else {
            $payment->reservation->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('success', 'Status verifikasi pembayaran berhasil diperbarui.');
    }
}
