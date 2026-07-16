<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        // Menggunakan withTrashed() agar statistik menghitung data yang di-soft delete juga
        $stats = [
            'total' => Reservation::withTrashed()->count(),
            'pending' => Reservation::withTrashed()->where('status', 'pending')->count(),
            'approved' => Reservation::withTrashed()->where('status', 'approved')->count(),
            'rejected' => Reservation::withTrashed()->where('status', 'rejected')->count(),
        ];

        // Menggunakan withTrashed() di query utama dan closure relasi
        $reservations = Reservation::withTrashed()
            ->with([
                'user' => function ($query) {
                    $query->withTrashed(); // Agar nama user tetap muncul jika user di-soft delete
                },
                'table' => function ($query) {
                    $query->withTrashed(); // Agar nomor meja tetap muncul jika meja di-soft delete
                },
            ])
            ->when($status === 'pending', function ($query) {
                return $query->where('status', 'pending');
            })
            ->when($status === 'history', function ($query) {
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
