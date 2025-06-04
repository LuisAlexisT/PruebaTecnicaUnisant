<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedesSeeder extends Seeder
{
    public function run()
    {
        DB::table('sedes')->insert([
            ['name' => 'Rectoria', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Zapopan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Orizaba', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
