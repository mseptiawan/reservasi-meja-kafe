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
        $tables = Table::where('is_active', true)->orderBy('area', 'asc')->orderBy('table_number', 'asc')->get();

        return view('pelanggan.reservasi.index', compact('tables'));
    }

    /**
     * Tampilkan form input detail waktu reservasi
     */
    public function create($table_id)
    {
        $table = Table::findOrFail($table_id);

        $existingBookings = Reservation::where('table_id', $table_id)->where('reservation_date', '>=', date('Y-m-d'))->where('status', 'approved')->orderBy('reservation_date', 'asc')->orderBy('start_time', 'asc')->get();

        return view('pelanggan.reservasi.create', compact('table', 'existingBookings'));
    }

    /**
     * Proses simpan data reservasi ke database
     */
    public function store(Request $request)
    {
        $table = Table::findOrFail($request->table_id);

        $request->validate(
            [
                'table_id' => 'required|exists:tables,id',
                'reservation_date' => 'required|date|after_or_equal:today',
                'start_time' => 'required',
                'end_time' => 'required|after:start_time',
                'guests_count' => 'required|integer|min:1|max:' . $table->capacity,
                'notes' => 'nullable|string',
            ],
            [
                'guests_count.max' => 'Jumlah tamu melebihi kapasitas maksimal Meja ' . $table->table_number . ' (Maksimal ' . $table->capacity . ' kursi).',
                'end_time.after' => 'Jam selesai harus lebih lambat dari jam mulai.',
            ],
        );

        $requestedDate = $request->reservation_date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        $isBooked = Reservation::where('table_id', $request->table_id)
            ->where('reservation_date', $requestedDate)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)->where('end_time', '>', $startTime);
            })
            ->exists();

        if ($isBooked) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['start_time' => 'Maaf, meja ini sudah dipesan oleh pelanggan lain pada rentang waktu tersebut (' . $startTime . ' - ' . $endTime . '). Silakan pilih jam atau meja lain.']);
        }

        $reservationCode = 'RES-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));

        $reservation = Reservation::create([
            'reservation_code' => $reservationCode,
            'user_id' => Auth::id(),
            'table_id' => $request->table_id,
            'reservation_date' => $requestedDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'guests_count' => $request->guests_count,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('reservasi.show', $reservation->id)->with('success', 'Reservasi berhasil diajukan!');
    }
    public function history(Request $request)
    {
        $status = $request->get('status', 'pending');

        $stats = [
            'total' => Reservation::where('user_id', Auth::id())->count(),
            'pending' => Reservation::where('user_id', Auth::id())->where('status', 'pending')->count(),
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

        if (Auth::user()->role !== 'admin' && $reservation->user_id !== Auth::id()) {
            abort(403, 'Akses tidak sah.');
        }

        return view('pelanggan.reservasi.detail', compact('reservation'));
    }
}
