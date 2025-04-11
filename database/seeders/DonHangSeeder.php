<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('don_hang')->insert([
            [
                'user_id' => '1',
                'sanpham_id' => '1',
               
                "tongtien" => '500000',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            
        ]);
    }
}
