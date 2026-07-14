<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{   
    public function index(Request $request)
    {
        $search = $request->get('search');

        $customers = User::where('role', 'pelanggan')
            ->where('status_verifikasi', 'active')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('customer_code', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.customers.index', compact('customers', 'search'));
    }
}
