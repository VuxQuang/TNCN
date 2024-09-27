<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quizzes')->insert([
            [
                'question' => 'Từ "Mèo" trong tiếng Nhật là gì?',
                'wrong_answer1' => 'サル', // Khỉ
                'wrong_answer2' => 'イヌ', // Chó
                'wrong_answer3' => 'ウシ', // Bò
                'correct_answer' => 'ネコ', // Mèo
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Xe đạp" trong tiếng Nhật là gì?',
                'wrong_answer1' => 'バス', // Xe buýt
                'wrong_answer2' => '車', // Ô tô
                'wrong_answer3' => '電車', // Tàu điện
                'correct_answer' => '自転車', // Xe đạp
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Nhà" trong tiếng Nhật là gì?',
                'wrong_answer1' => '学校', // Trường học
                'wrong_answer2' => '店', // Cửa hàng
                'wrong_answer3' => '図書館', // Thư viện
                'correct_answer' => '家', // Nhà
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Sách" trong tiếng Nhật là gì?',
                'wrong_answer1' => '鉛筆', // Bút chì
                'wrong_answer2' => '机', // Bàn
                'wrong_answer3' => 'ノート', // Vở
                'correct_answer' => '本', // Sách
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Trời mưa" trong tiếng Nhật là gì?',
                'wrong_answer1' => '雪', // Tuyết
                'wrong_answer2' => '風', // Gió
                'wrong_answer3' => '晴れ', // Nắng
                'correct_answer' => '雨', // Mưa
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Cơm" trong tiếng Nhật là gì?',
                'wrong_answer1' => 'パン', // Bánh mì
                'wrong_answer2' => '魚', // Cá
                'wrong_answer3' => '肉', // Thịt
                'correct_answer' => 'ご飯', // Cơm
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Nước" trong tiếng Nhật là gì?',
                'wrong_answer1' => '牛乳', // Sữa
                'wrong_answer2' => 'お茶', // Trà
                'wrong_answer3' => 'ジュース', // Nước ép
                'correct_answer' => '水', // Nước
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Mặt trời" trong tiếng Nhật là gì?',
                'wrong_answer1' => '月', // Mặt trăng
                'wrong_answer2' => '星', // Ngôi sao
                'wrong_answer3' => '雲', // Mây
                'correct_answer' => '太陽', // Mặt trời
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Xe buýt" trong tiếng Nhật là gì?',
                'wrong_answer1' => '車', // Ô tô
                'wrong_answer2' => '自転車', // Xe đạp
                'wrong_answer3' => '電車', // Tàu điện
                'correct_answer' => 'バス', // Xe buýt
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Từ "Bệnh viện" trong tiếng Nhật là gì?',
                'wrong_answer1' => '学校', // Trường học
                'wrong_answer2' => '公園', // Công viên
                'wrong_answer3' => '駅', // Nhà ga
                'correct_answer' => '病院', // Bệnh viện
                'video_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
