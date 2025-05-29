<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternative;

class AlternativesSeeder extends Seeder
{
    public function run()
    {
        Alternative::insert([
            [
                'name' => 'Billiard Galaxy',
                'address' => 'Jl. Sudirman No.10',
                'contact' => '08123456789',
                'description' => 'Tempat billiard premium dengan fasilitas lengkap.',
                'open_hour' => '10:00:00',
                'close_hour' => '23:00:00',
            ],
            [
                'name' => 'Champion Billiard',
                'address' => 'Jl. Gatot Subroto No.5',
                'contact' => '08987654321',
                'description' => 'Tempat santai dan nyaman untuk bermain billiard.',
                'open_hour' => '09:00:00',
                'close_hour' => '22:00:00',
            ],
            [
                'name' => 'Starlight Billiard',
                'address' => 'Jl. Thamrin No.20',
                'contact' => '082212341234',
                'description' => 'Billiard center dengan banyak meja dan cafe.',
                'open_hour' => '11:00:00',
                'close_hour' => '00:00:00',
            ],
            [
                'name' => 'Arena Billiard Club',
                'address' => 'Jl. Diponegoro No.15',
                'contact' => '087812345678',
                'description' => 'Tempat latihan dan turnamen rutin.',
                'open_hour' => '08:00:00',
                'close_hour' => '22:00:00',
            ],
            [
                'name' => 'Relax Billiard Lounge',
                'address' => 'Jl. Ahmad Yani No.8',
                'contact' => '081333334444',
                'description' => 'Suasana tenang dan cocok untuk keluarga.',
                'open_hour' => '10:00:00',
                'close_hour' => '21:00:00',
            ],
        ]);
    }
}
