<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert(
            [
                'name' => 'Halo76',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'), // Bạn có thể sử dụng Hash để mã hóa mật khẩu
                'role' => 'admin',
            ]
        );
    }
}
