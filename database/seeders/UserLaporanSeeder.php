<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user role "user"
        User::create([
            'name' => 'User Admin',
            'username' => 'useradmin',
            'email' => 'admin@example.com',
            'whatsapp' => '082191170349',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // Buat user role "user"
        User::create([
            'name' => 'User Lain',
            'username' => 'userlain',
            'email' => 'lain@example.com',
            'whatsapp' => '089123324232',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

        // Buat user role "user"
        $user = User::create([
            'name' => 'User Demo',
            'username' => 'userdemo',
            'email' => 'user@example.com',
            'whatsapp' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Status yang tersedia
        $statuses = ['pending', 'diproses', 'selesai'];

        // Buat 6 laporan
        for ($i = 0; $i < 6; $i++) {
            Laporan::create([
                'user_id' => $user->id,
                'judul' => 'Laporan ' . ($i + 1),
                'deskripsi' => 'Deskripsi laporan ke-' . ($i + 1),
                'tanggal' => now()->subDays($i),
                'gambar' => 'gambar' . ($i + 1) . '.jpg',
                'status' => $statuses[$i % count($statuses)], // biar status bergantian
                'respon' => 'Respon untuk laporan ke-' . ($i + 1),
            ]);
        }
    }
}
