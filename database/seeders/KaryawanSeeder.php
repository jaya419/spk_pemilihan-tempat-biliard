<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('karyawans')->truncate();
        DB::table('karyawans')->insert([
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@example.com',
                'telepon' => '081298765432',
                'alamat' => 'Jl. Sudirman No. 25, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Joko Susilo',
                'email' => 'joko.susilo@example.com',
                'telepon' => '081311223344',
                'alamat' => 'Jl. Gatot Subroto No. 5, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'telepon' => '081556789012',
                'alamat' => 'Jl. Pahlawan No. 30, Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
