<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criterion;

class CriteriaSeeder extends Seeder
{
    public function run()
    {
        Criterion::insert([
            ['name' => 'Harga',     'type' => 'cost',    'weight' => 0.3],
            ['name' => 'Fasilitas', 'type' => 'benefit', 'weight' => 0.4],
            ['name' => 'Jarak',     'type' => 'cost',    'weight' => 0.2],
            ['name' => 'Rating',    'type' => 'benefit', 'weight' => 0.1],
        ]);
    }
}
