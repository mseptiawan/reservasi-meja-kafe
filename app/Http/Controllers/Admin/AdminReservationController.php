<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil status dari URL, kalau kosong default-nya 'pending'
        $status = $request->get('status', 'pending');

        // 2. Hitung statistik untuk card (ini tetap menghitung status asli DB)
        $stats = [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'approved' => Reservation::where('status', 'approved')->count(),
            'rejected' => Reservation::where('status', 'rejected')->count(),
        ];

        // 3. Modifikasi query agar paham arti parameter 'history'
        $reservations = Reservation::with(['user', 'table'])
            ->when($status === 'pending', function ($query) {
                // Jika ?status=pending, cari yang statusnya 'pending'
                return $query->where('status', 'pending');
            })
            ->when($status === 'history', function ($query) {
                // JIKA ?status=history, cari data yang statusnya 'approved' ATAU 'rejected'
                return $query->whereIn('status', ['approved', 'rejected']);
            })
            ->latest()
            ->paginate(10);

        return view('admin.reservations.index', compact('reservations', 'status', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
    }
}
