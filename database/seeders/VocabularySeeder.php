<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vocabulary = [
            ['word' => 'Xin chào', 'meaning' => 'こんにちは'],
            ['word' => 'Cảm ơn', 'meaning' => 'ありがとう'],
            ['word' => 'Tạm biệt', 'meaning' => 'さようなら'],
            ['word' => 'Chúc mừng', 'meaning' => 'おめでとう'],
            ['word' => 'Xin lỗi', 'meaning' => 'ごめんなさい'],
            ['word' => 'Hẹn gặp lại', 'meaning' => 'また会いましょう'],
            ['word' => 'Có thể', 'meaning' => 'できる'],
            ['word' => 'Không thể', 'meaning' => 'できない'],
            ['word' => 'Giúp đỡ', 'meaning' => '助ける'],
            ['word' => 'Học', 'meaning' => '勉強する'],
            ['word' => 'Ăn', 'meaning' => '食べる'],
            ['word' => 'Uống', 'meaning' => '飲む'],
            ['word' => 'Đi', 'meaning' => '行く'],
            ['word' => 'Đến', 'meaning' => '来る'],
            ['word' => 'Ngủ', 'meaning' => '寝る'],
            ['word' => 'Mua', 'meaning' => '買う'],
            ['word' => 'Bán', 'meaning' => '売る'],
            ['word' => 'Thích', 'meaning' => '好き'],
            ['word' => 'Ghét', 'meaning' => '嫌い'],
            ['word' => 'Sách', 'meaning' => '本'],
            ['word' => 'Trường', 'meaning' => '学校']
        ];

        DB::table('vocabulary')->insert($vocabulary);
    }
}
