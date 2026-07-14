<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountStatusController extends Controller
{
    public function index()
    {
        return view('auth.cek-status');
    }

    public function check(Request $request)
    {
        $request->validate([
            'search_key' => ['required', 'string', 'max:255'],
        ], [
            'search_key.required' => 'Masukkan Email atau Kode Customer Anda.',
        ]);

        $user = User::where('email', $request->search_key)
                    ->orWhere('customer_code', $request->search_key)
                    ->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Data akun tidak ditemukan. Pastikan Email atau Kode Customer benar.');
        }

        return back()->withInput()->with('account_user', $user);
    }
}