<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $tables = Table::where('is_active', true)
            ->orderBy('area', 'asc')
            ->orderBy('table_number', 'asc')
            ->get();

        return view('pelanggan.reservasi.index', compact('tables'));
    }

    /**
     * Tampilkan form input detail waktu reservasi
     */
    public function create($table_id)
    {
        $table = Table::findOrFail($table_id);
        return view('pelanggan.reservasi.create', compact('table'));
    }

    /**
     * Proses simpan data reservasi ke database
     */
    public function store(Request $request)
    {
        $table = Table::findOrFail($request->table_id);

        // 2. Lakukan validasi ketat
        $request->validate([
            'table_id'         => 'required|exists:tables,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time'       => 'required',
            'end_time'         => 'required|after:start_time',
            'guests_count'     => 'required|integer|min:1|max:' . $table->capacity,
            'notes'            => 'nullable|string',
        ], [
            'guests_count.max' => 'Jumlah tamu melebihi kapasitas maksimal Meja ' . $table->table_number . ' (Maksimal ' . $table->capacity . ' kursi).',
            'end_time.after'   => 'Jam selesai harus lebih lambat dari jam mulai.',
        ]);

        $reservationCode = 'RES-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));

        $reservation = Reservation::create([
            'reservation_code' => $reservationCode,
            'user_id'         => Auth::id(),
            'table_id'        => $request->table_id,
            'reservation_date' => $request->reservation_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'guests_count'    => $request->guests_count,
            'status'          => 'pending',
            'notes'           => $request->notes,
        ]);

        return redirect()->route('reservasi.show', $reservation->id)->with('success', 'Reservasi berhasil diajukan!');
    }
    public function history(Request $request)
    {
        $status = $request->get('status', 'pending');

        $stats = [
            'total'    => Reservation::where('user_id', Auth::id())->count(),
            'pending'  => Reservation::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved' => Reservation::where('user_id', Auth::id())->where('status', 'approved')->count(),
        ];

        $reservations = Reservation::where('user_id', Auth::id())
            ->with('table')
            ->when($status === 'pending', function ($query) {
                return $query->where('status', 'pending');
            })
            ->when($status === 'history', function ($query) {
                return $query->whereIn('status', ['approved', 'rejected']);
            })
            ->latest()
            ->paginate(10);

        return view('pelanggan.reservasi.history', compact('reservations', 'status', 'stats'));
    }
    /**
     * Tampilkan Nota/Detail Struk Reservasi
     */
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'table'])->findOrFail($id);

        // Jika yang login BUKAN admin DAN BUKAN pemilik reservasi, cekal.
        if (Auth::user()->role !== 'admin' && $reservation->user_id !== Auth::id()) {
            abort(403, 'Akses tidak sah.');
        }

        return view('pelanggan.reservasi.detail', compact('reservation'));
    }
}
