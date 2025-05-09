<?php

namespace Database\Seeders;

use App\Models\BinhLuan;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SanPhamSeeder::class);
        $this->call(LienHeSeeder::class);
        $this->call(NewsSeeder::class); 
    }
}
