<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tags')->insert([
            [
                'name' => json_encode(['en' => 'Men', 'ar' => 'رجالي']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Casual', 'ar' => 'كاجوال']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Sport', 'ar' => 'رياضي']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
