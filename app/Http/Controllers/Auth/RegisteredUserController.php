<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:20'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $customerCode = 'CS-' . date('Ymd') . strtoupper(bin2hex(random_bytes(2)));

        $user = User::create([
            'customer_code' => $customerCode,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',              
            'status_verifikasi' => 'pending',   
        ]);

        event(new Registered($user));

        return redirect('/')->with('success', 'Pendaftaran berhasil! Akun Anda dengan kode ' . $customerCode . ' sedang dalam antrean verifikasi Admin.');
    }
}