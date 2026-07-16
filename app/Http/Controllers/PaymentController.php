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
        $status = $request->get('status', 'pending');

        $unpaidCount = Reservation::where('user_id', $userId)->where('status', 'approved')->whereDoesntHave('payment')->count();

        $pendingVerificationCount = Payment::whereHas('reservation', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'pending')
            ->count();

        $successCount = Payment::whereHas('reservation', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'success')
            ->count();

        $failedCount = Payment::whereHas('reservation', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'failed')
            ->count();

        // Stats untuk komponen UI
        $stats = [
            'total' => $unpaidCount + $pendingVerificationCount + $successCount + $failedCount,
            'pending' => $unpaidCount + $pendingVerificationCount,
            'success' => $successCount,
            'failed' => $failedCount,
        ];

        $displayData = [];

        if ($status === 'pending') {
            $unpaidReservations = Reservation::with('table')
                ->where('user_id', $userId)
                ->where('status', 'approved')
                ->whereDoesntHave('payment')
                ->orderBy('reservation_date', 'asc')
                ->get()
                ->map(function ($item) {
                    $item->display_type = 'unpaid';
                    return $item;
                });

            $pendingPayments = Payment::with(['reservation.table'])
                ->whereHas('reservation', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })
                ->where('status', 'pending')
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->display_type = 'pending_verification';
                    return $item;
                });

            $displayData = $unpaidReservations->concat($pendingPayments);
        } else {
            $displayData = Payment::with(['reservation.table'])
                ->whereHas('reservation', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })
                ->whereIn('status', ['success', 'failed'])
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->display_type = 'history';
                    return $item;
                });
        }

        return view('pelanggan.payment.index', compact('displayData', 'status', 'stats'));
    }
    /**
     * Halaman detail reservasi beserta instruksi pembayaran & Form Upload
     */
    public function create($reservation_id)
    {
        $reservation = Reservation::with('table')->where('user_id', Auth::id())->where('status', 'approved')->findOrFail($reservation_id);

        $bankInstructions = [['name' => 'Bank BCA (Manual Transfer)', 'number' => '8015-2234-99', 'holder' => 'PesanMeja Cafe'], ['name' => 'Mandiri Virtual Account', 'number' => '8803-0821-0249-3940', 'holder' => 'PesanMeja - ' . Auth::user()->name]];

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

        $filePath = $request->file('proof_of_payment')->store('proofs', 'public');

        $paymentCode = 'PAY-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));

        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_code' => $paymentCode,
            'amount' => $request->amount,
            'proof_of_payment' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('reservasi.history')->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi keuangan dari admin.');
    }
    public function adminIndex(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $status = $request->get('status', 'pending');

        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'success' => Payment::where('status', 'success')->count(),
            'failed' => Payment::where('status', 'failed')->count(),
        ];

        $payments = Payment::with(['reservation.user', 'reservation.table'])
            ->when($status === 'pending', function ($query) {
                return $query->where('status', 'pending');
            })
            ->when($status === 'history', function ($query) {
                return $query->whereIn('status', ['success', 'failed']);
            })
            ->latest()
            ->get();

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
        ]);

        $payment->update([
            'status' => $request->status,
        ]);

        if ($request->status === 'success') {
            $payment->reservation->update(['status' => 'approved']);
        } else {
            $payment->reservation->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('success', 'Status verifikasi pembayaran berhasil diperbarui.');
    }
}
