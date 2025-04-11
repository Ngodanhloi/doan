<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienHeSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lienhe')->insert([
            [
                'hovaten' => 'nguyen van a',
                'email' => 'nguyena@mail.com',
                "diachi" => "linh chieu,tp thu duc",
                "sdt" => "0123456673",
                "loinhan" => "San pham a....",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'hovaten' => 'nguyen van b',
                'email' => 'nguyenb@mail.com',
                "diachi" => "linh dong,tp thu duc",
                "sdt" => "0123456569",
                "loinhan" => "San pham aaa....",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'hovaten' => 'nguyen thi mai',
                'email' => 'mainguyen@mail.com',
                "diachi" => "thuan an,binh duong",
                "sdt" => "01236333673",
                "loinhan" => "Huong dan su dung....",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'hovaten' => 'npham van muoi',
                'email' => 'phammuoi@mail.com',
                "diachi" => "thu dau mot,binh duong",
                "sdt" => "0123376474",
                "loinhan" => "Huong dan....",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
