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
            'description' => 'Làm quen với bảng chữ cái tiếng Việt',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 2',
            'description' => 'Phát âm nguyên âm và phụ âm cơ bản',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 3',
            'description' => 'Giới thiệu về thanh điệu trong tiếng Việt',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 4',
            'description' => 'Từ vựng cơ bản: Chào hỏi và giao tiếp hàng ngày',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 5',
            'description' => 'Cách đặt câu hỏi trong tiếng Việt',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 6',
            'description' => 'Ngữ pháp: Các loại từ và cách sử dụng',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 7',
            'description' => 'Luyện tập phát âm: Bài học với nguyên âm đôi',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 8',
            'description' => 'Từ vựng về các đồ vật thông thường',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 9',
            'description' => 'Cách diễn đạt ý kiến và cảm xúc trong tiếng Việt',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 10',
            'description' => 'Hội thoại về mua sắm và thương mại',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 11',
            'description' => 'Các từ vựng về thức ăn và đồ uống',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 12',
            'description' => 'Giới thiệu về văn hóa Việt Nam',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 13',
            'description' => 'Luyện tập với các thanh điệu khác nhau',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 14',
            'description' => 'Ngữ pháp nâng cao: Cấu trúc câu phức',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 15',
            'description' => 'Hội thoại về du lịch và địa điểm',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 16',
            'description' => 'Các mẫu câu dùng trong giao tiếp xã hội',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 17',
            'description' => 'Từ vựng về các hoạt động hàng ngày',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 18',
            'description' => 'Hội thoại về sức khỏe và y tế',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 19',
            'description' => 'Luyện tập giao tiếp trong công việc',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Lesson 20',
            'description' => 'Ôn tập và kiểm tra cuối khóa',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

}
