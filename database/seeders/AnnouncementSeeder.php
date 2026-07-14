<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = User::where('role', 'admin')->first()?->id ?? 1;

        $announcements = [
            [
                'title' => 'Diskon Spesial Senja Akhir Pekan Potongan 20%',
                'content' => 'Nikmati akhir pekanmu di Senja Space dengan promo diskon 20% untuk semua varian kopi espresso base. Berlaku setiap hari Sabtu dan Minggu mulai pukul 16:00 - 19:00 WIB. Jangan sampai kelewatan ya!',
                'type' => 'promo',
                'status' => 'published',
                'image' => 'https://img.magnific.com/foto-gratis/close-up-gambar-kopi-pagi-dan-jus-wortel-sehat-kafe-sehat-organik-hidangan-trendi-buatan-tangan_291049-1378.jpg?semt=ais_hybrid&w=740&q=80',
            ],
            [
                'title' => 'Live Acoustic Night: Bersenda di Senja Space',
                'content' => 'Hadirilah keseruan malam keakraban bersama komunitas musik lokal dalam acara Live Acoustic Night. Catat tanggalnya: Jumat ini, mulai pukul 19.30 WIB sampai selesai. Reservasi mejamu sekarang sebelum penuh!',
                'type' => 'event',
                'status' => 'published',
                'image' => 'https://t3.ftcdn.net/jpg/04/10/82/30/360_F_410823090_x4vE8NQ2g0zwiJ9AUXSmOAUWk5MZdugQ.jpg', 
            ],
            [
                'title' => 'Pemeliharaan Sistem Terjadwal Aplikasi Pemesanan',
                'content' => 'Untuk meningkatkan kenyamanan Anda dalam melakukan reservasi meja, kami akan melakukan maintenance berkala pada sistem aplikasi pada hari Senin pukul 01:00 - 04:00 WIB. Selama waktu tersebut, aplikasi tidak dapat diakses.',
                'type' => 'maintenance',
                'status' => 'published',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvGkWUq6kyUyK2hnuRJcF6yVrf3RIXf-vD5lfC-ogEPQ&s=10', // Laptop/Server
            ],
            [
                'title' => 'Pengumuman Pemenang Giveaway Foto Senja Cerita',
                'content' => 'Selamat kepada para pemenang kompetisi foto kreatif #SenjaCerita periode bulan ini. Hadiah berupa voucher free coffee selama satu minggu penuh dapat diklaim melalui kasir dengan menunjukkan profil akun terverifikasi Anda.',
                'type' => 'announcement',
                'status' => 'published',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk5Ldcp1qpeO3lWM05PWEo3hpcib4-iGpMmzOc59c14JFR0j4cICYj5kCL&s=10', // Perayaan/Selebrasi
            ],
            [
                'title' => 'Kebijakan Internal Mengenai Kebersihan Area Kerja',
                'content' => 'Diberitahukan kepada seluruh staff Senja Space untuk selalu menjaga kerapihan dan sterilisasi alat espresso machine pasca shift malam berakhir. Panduan kebersihan baru dapat diunduh di dashboard internal masing-masing.',
                'type' => 'info_internal',
                'status' => 'published',
                'image' => 'https://img.magnific.com/vektor-gratis/komposisi-pembersihan-polusi-ekologi-dengan-pemandangan-kota-lanskap-kota-dan-sekelompok-orang-dewasa-dan-anak-anak-mengumpulkan-sampah-ilustrasi-vektor_1284-72974.jpg?semt=ais_hybrid&w=740&q=80', // Pembersihan/Internal
            ],
            [
                'title' => 'Menu Baru Sweet Treat Series Kini Tersedia',
                'content' => 'Cicipi perpaduan manisnya pastry premium terbaru kami, Croissant Almond dan Cinnamon Roll, yang sangat cocok menemani segelas es kopi susu aren khas Senja Space.',
                'type' => 'promo',
                'status' => 'published',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGlKpUUUi7-uFqIPVqqZ1psBY9YEEa7Spco2TjNxE2NA&s=10', // Pastry/Bakery
            ],
            [
                'title' => 'Workshop Kerajinan Tangan Bersama Komunitas Kreatif',
                'content' => 'Senja Space berkolaborasi dengan @KreatifPalembang mengadakan kelas merajut santai pada hari Minggu besok. Biaya pendaftaran sudah termasuk benang, jarum, dan free signature drink.',
                'type' => 'event',
                'status' => 'published',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqYyXy9kcotYLARPha4LF1T48t-PWqd-Hc_6bEPi2biA&s=10', // Workshop/Kerajinan
            ],
            [
                'title' => 'Perubahan Jam Operasional Selama Hari Raya',
                'content' => 'Menyambut libur hari raya keagamaan, Senja Space akan mengalami sedikit penyesuaian jam operasional. Kami buka mulai pukul 13:00 WIB dan tutup lebih awal pada pukul 21:00 WIB.',
                'type' => 'announcement',
                'status' => 'published',
                'image' => 'https://online.visual-paradigm.com/repository/images/9ab3a3d5-fa39-4126-82dd-ebd2a3e4c8e5-2/calendars-design/natural-landscape-calendar-2022.png', // Kalender/Waktu
            ],
            [
                'title' => 'Draft Pengumuman Kerja Sama Merchant Dompet Digital',
                'content' => 'Konten ini masih berupa konsep kerja sama sistem pembayaran cashback 10% menggunakan QRIS dompet digital terbaru yang akan segera diluncurkan bulan depan.',
                'type' => 'promo',
                'status' => 'draft',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2l_fLCYp-l7Begq9O72jf4yfEHbpCWOb7RicE5L_bQA&s=10', // Pembayaran/Keuangan
            ],
            [
                'title' => 'Arsip Event Coffee Cupping Session Vol. 1',
                'content' => 'Dokumentasi dan catatan rasa dari aktivitas edukasi coffee cupping session yang telah sukses diselenggarakan bersama para roaster lokal bulan lalu.',
                'type' => 'event',
                'status' => 'archived', 
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkmMq7mXrlnGg5zHxONBvHnewwbfKw3wpDY0h7p1txe-fQudWWeq590nA&s=10', // Kopi
            ],
        ];

        foreach ($announcements as $data) {
            Announcement::create([
                'user_id' => $adminId,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'image' => $data['image'],
                'type' => $data['type'],
                'status' => $data['status'],
                'published_at' => $data['status'] === 'published' ? now() : null,
            ]);
        }
    }
}