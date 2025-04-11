<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietDonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chitietdonhang')->insert([
            [
                'donhang_id' => 1,
                'sanpham_id' => 21,
                'soluong' => 2,
                'gia_sp' => 50.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'donhang_id' => 2,
                'sanpham_id' => 22,
                'soluong' => 1,
                'gia_sp' => 25.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'donhang_id' => 3,
                'sanpham_id' => 23,
                'soluong' => 1,
                'gia_sp' => 28.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'donhang_id' => 4,
                'sanpham_id' => 24,
                'soluong' => 1,
                'gia_sp' => 30.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Thêm các bản ghi khác tùy theo nhu cầu của bạn
        ]);
    }
}
