<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'ten' => 'Skincare',
                'mota' => 'Danh mục sản phẩm chăm sóc da mặt',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'ten' => 'Makeup',
                'mota' => 'Danh mục sản phẩm trang điểm mặt',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'ten' => 'Haircare',
                'mota' => 'Danh mục sản phẩm chăm sóc tóc',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'ten' => 'Fragrance',
                'mota' => 'Danh mục sản phẩm hương thơm',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
