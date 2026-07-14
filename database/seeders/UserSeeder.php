<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'customer_code'     => 'CS-0293',
            'name'              => 'Septiawan',
            'email'             => 'mseptiawan017@gmail.com',
            'phone_number'      => '081234567890',
            'identity_number'   => '1671000000000001', 
            'role'              => 'admin',
            'status_verifikasi' => 'active',
            'password'          => Hash::make('Smartlinux3'),
        ]);

        $names = ['Pelanggan Satu', 'Pelanggan Dua', 'Pelanggan Tiga'];
        $emails = ['pelanggan1@example.com', 'pelanggan2@example.com', 'pelanggan3@example.com'];
        $statuses = ['active', 'pending', 'rejected'];

        for ($i = 0; $i < 3; $i++) {
            $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

            User::create([
                'customer_code'     => 'PLG-' . $randomDigits,
                'name'              => $names[$i],
                'email'             => $emails[$i],
                'phone_number'      => '08129999000' . $i,
                'role'              => 'pelanggan',
                'status_verifikasi' => $statuses[$i],
                'password'          => Hash::make('lspsecret'),
            ]);
        }
    }
}