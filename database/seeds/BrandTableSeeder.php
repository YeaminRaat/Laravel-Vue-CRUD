<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Samsung',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('brands')->insert([
            'name' => 'Bata',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('brands')->insert([
            'name' => 'Asus',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('brands')->insert([
            'name' => 'Richman',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('brands')->insert([
            'name' => 'Intel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
