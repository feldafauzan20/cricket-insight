<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Pastikan ini ada
use Illuminate\Support\Facades\Hash; // <-- Pastikan ini ada

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin Akun Admin Permanen
        User::firstOrCreate(
            ['email' => 'pci@gmail.com'],
            [
                'name' => 'pci',
                'password' => Hash::make('pci'), // Passwordnya: pcia
            ]
        );

        // 2. Panggil seeder lainnya
        $this->call([
            CategoryTagSeeder::class,
            DummyContentSeeder::class,
            PageSlotSeeder::class,
            OngoingTournamentSeeder::class,
            BbiWbbiSettingSeeder::class,
        ]);
    }
}