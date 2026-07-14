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
        // 1. Data Admin
        User::create([
            'customer_code'     => 'CS-0293',
            'name'              => 'Septiawan',
            'email'             => 'mseptiawan017@gmail.com',
            'phone_number'      => '081234567890',
            'role'              => 'admin',
            'status_verifikasi' => 'active',
            'password'          => Hash::make('lspsecret'),
        ]);

        // 2. Data Pelanggan Awal (3 Variasi Status)
    $names = ['wawan', 'Pelanggan Dua', 'Pelanggan Tiga'];
        $emails = ['wawan@gmail.com', 'pelanggan2@example.com', 'pelanggan3@example.com'];
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

        // 3. Tambahan 10 Pelanggan Baru (Nama Real & Status Active)
        $realNames = [
            'Rian Hidayat', 
            'Dewi Lestari', 
            'Budi Santoso', 
            'Siti Aminah', 
            'Rizky Pratama', 
            'Aditya Wijaya', 
            'Fitriani Kusuma', 
            'Andika Putra', 
            'Mega Utami', 
            'Dimas Saputra'
        ];

        $realEmails = [
            'rian.hidayat@gmail.com',
            'dewi.lestari@gmail.com',
            'budi.santoso@gmail.com',
            'siti.aminah@gmail.com',
            'rizky.pratama@gmail.com',
            'aditya.wijaya@gmail.com',
            'fitriani.kusuma@gmail.com',
            'andika.putra@gmail.com',
            'mega.utami@gmail.com',
            'dimas.saputra@gmail.com'
        ];

        foreach ($realNames as $index => $name) {
            $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

            User::create([
                'customer_code'     => 'PLG-' . $randomDigits,
                'name'              => $name,
                'email'             => $realEmails[$index],
                'phone_number'      => '0813' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT), 
                'role'              => 'pelanggan',
                'status_verifikasi' => 'active', 
                'password'          => Hash::make('lspsecret'),
            ]);
        }
    }
}