<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'url' => 'https://www.youtube.com/watch?v=vaAh9isaAWo',
            'title' => 'Bài 1',
            'description' => 'Giới thiệu tiếng việt',
        ]);
    }
}
