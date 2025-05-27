<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('kriterias')->truncate();
        DB::table('kriterias')->insert([
            [
                'nama' => 'Disiplin',
                'bobot' => 25,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tepat waktu',
                'bobot' => 20,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Berpakaian rapih',
                'bobot' => 20,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bisa membantu rekan kerja',
                'bobot' => 15,
                'tipe' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Hasil kerja',
                'bobot' => 20,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
