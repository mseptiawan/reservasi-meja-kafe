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

        $stats = [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'approved' => Reservation::where('status', 'approved')->count(),
            'rejected' => Reservation::where('status', 'rejected')->count(),
        ];

        $reservations = Reservation::with(['user', 'table'])
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
