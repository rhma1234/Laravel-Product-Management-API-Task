<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => json_encode(['en' => 'Electronics', 'ar' => 'إلكترونيات']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Clothing', 'ar' => 'ملابس']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
