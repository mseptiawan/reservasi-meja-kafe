<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Announcement;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $announcements = Announcement::where('status', 'published')->latest()->take(3)->get();

        if ($user->role === 'admin') {
            $stats = [
                'pending_users' => User::where('status_verifikasi', 'pending')->count(),
                'pending_payments' => Payment::where('status', 'pending')->count(),
                'pending_reservations' => Reservation::where('status', 'pending')->count(),
                'total_customers' => User::where('role', 'pelanggan')->count(),
            ];

            $recentReservations = Reservation::with('user')->latest()->take(5)->get();

            return view('dashboard', compact('announcements', 'stats', 'recentReservations'));
        } else {
            $activeReservation = Reservation::where('user_id', $user->id)->where('status', 'approved')->whereDoesntHave('payment')->latest()->first();

            $myRecentBookings = Reservation::where('user_id', $user->id)->latest()->take(3)->get();

            return view('dashboard', compact('announcements', 'activeReservation', 'myRecentBookings'));
        }
    }
}
