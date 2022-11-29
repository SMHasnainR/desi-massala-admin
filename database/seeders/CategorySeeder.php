<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        [
            'id' => 1,
            'name' => 'Vegetable',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'name' => 'Non-Vegetable',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'name' => 'Healthy',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}
