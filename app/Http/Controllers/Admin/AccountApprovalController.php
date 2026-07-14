<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountApprovalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $stats = [
            'total'    => User::where('role', 'pelanggan')->count(),
            'pending'  => User::where('role', 'pelanggan')->where('status_verifikasi', 'pending')->count(),
            'rejected' => User::where('role', 'pelanggan')->where('status_verifikasi', 'rejected')->count(),
        ];

        $users = User::where('role', 'pelanggan')
            ->when($status === 'pending', function ($query) {
                return $query->where('status_verifikasi', 'pending');
            })
            ->when($status === 'rejected', function ($query) {
                return $query->whereIn('status_verifikasi', ['rejected', 'active']);
            })
            ->latest()
            ->paginate(10);

        return view('admin.approvals.index', compact('users', 'status', 'stats'));
    }

    public function verify(Request $request, User $user)
    {
        $request->validate([
            'action' => ['required', 'in:active,rejected']
        ]);

        $action = $request->action;
        $statusLabel = $action === 'active' ? 'diaktifkan' : 'ditolak';

        $user->update([
            'status_verifikasi' => $action
        ]);

        return redirect()->route('admin.approvals.index', ['status' => $request->action === 'active' ? 'pending' : 'rejected'])
            ->with('success', "Akun pelanggan atas nama {$user->name} berhasil {$statusLabel}.");
    }
}
