<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('lessons')->insert([
            [
                'title' => 'Lesson 1',
                'description' => 'Làm quen với tiếng việt ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lesson 2',
                'description' => 'Phát âm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lesson 3',
                'description' => 'Luyện tập',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
