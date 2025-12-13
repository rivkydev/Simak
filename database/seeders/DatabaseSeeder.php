<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KelurahanSeeder::class,
            ProfilSeeder::class,
            SejarahSeeder::class,
            PotensiSeeder::class,
            StrukturPemerintahSeeder::class,
            SosialMediaSeeder::class,
            InformasiKontakSeeder::class,
            InformasiUmkmSeeder::class,
            JabatanSeeder::class,
            PegawaiSeeder::class,
        ]);


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
