<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Electronic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Lifestyle',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Cloths',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Fashion',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Sports',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
