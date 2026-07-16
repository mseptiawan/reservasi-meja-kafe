<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table; // Menggunakan Eloquent Model langsung agar bebas garis merah

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            // --- 4 MEJA INDOOR ---
            [
                'table_number' => 'I-01',
                'area' => 'Indoor',
                'capacity' => 2,
                'status' => 'available',
                'image' => 'tables/indoor-1.jpg',
                'description' => 'Meja minimalis dekat jendela utama, cocok untuk kerja santai atau berdua.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'I-02',
                'area' => 'Indoor',
                'capacity' => 4,
                'status' => 'available',
                'image' => 'tables/indoor-2.jpg',
                'description' => 'Meja tengah dengan sofa empuk, pas untuk kumpul keluarga atau meeting kecil.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'I-03',
                'area' => 'Indoor',
                'capacity' => 2,
                'status' => 'available',
                'image' => 'tables/indoor-3.jpg',
                'description' => 'Meja sudut yang tenang, dilengkapi dengan colokan listrik penuh, cocok untuk WFH.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'I-04',
                'area' => 'Indoor',
                'capacity' => 6,
                'status' => 'available',
                'image' => 'tables/indoor-4.jpg',
                'description' => 'Meja panjang di area tengah, cocok untuk grup besar atau komunitas yang sedang kumpul.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- 4 MEJA OUTDOOR ---
            [
                'table_number' => 'O-01',
                'area' => 'Outdoor',
                'capacity' => 4,
                'status' => 'available',
                'image' => 'tables/outdoor-1.jpg',
                'description' => 'Area merokok (smoking area) dengan pemandangan taman luar yang asri.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'O-02',
                'area' => 'Outdoor',
                'capacity' => 2,
                'status' => 'maintenance',
                'image' => 'tables/outdoor-2.jpg',
                'description' => 'Meja kayu area luar (sedang dalam perbaikan berkala pada sandaran kursi).',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'O-03',
                'area' => 'Outdoor',
                'capacity' => 4,
                'status' => 'available',
                'image' => 'tables/outdoor-3.jpg',
                'description' => 'Meja payung luar ruangan, adem di sore hari cocok untuk menikmati kopi santai.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'O-04',
                'area' => 'Outdoor',
                'capacity' => 2,
                'status' => 'available',
                'image' => 'tables/outdoor-4.jpg',
                'description' => 'Meja bar tinggi di sudut halaman luar, pas untuk nongkrong santai sendirian.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- 2 MEJA VIP ---
            [
                'table_number' => 'V-01',
                'area' => 'VIP Room',
                'capacity' => 8,
                'status' => 'available',
                'image' => 'tables/vip-1.jpg',
                'description' => 'Ruangan tertutup ber-AC dilengkapi dengan papan tulis dan smart TV untuk kebutuhan presentasi.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'V-02',
                'area' => 'VIP Room',
                'capacity' => 12,
                'status' => 'available',
                'image' => 'tables/vip-2.jpg',
                'description' => 'Ruangan rapat premium ukuran besar, kedap suara, sangat privat untuk jamuan bisnis.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Table::insert($tables);
    }
}
