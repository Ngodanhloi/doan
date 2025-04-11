<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            [
                'title' => 'News 1',
                'image_url' => 'image1.jpg',
                'description' => 'Description of News 1',
                'content' => 'Content of News 1',
                'posted_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'News 2',
                'image_url' => 'image2.jpg',
                'description' => 'Description of News 2',
                'content' => 'Content of News 2',
                'posted_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'News 3',
                'image_url' => 'image3.jpg',
                'description' => 'Description of News 3',
                'content' => 'Content of News 3',
                'posted_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
