<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show($id)
    {
        // Lấy các quiz liên quan đến video cụ thể
        $quizzes = Quiz::where('video_id', $id)->get();

        // Kiểm tra và chuẩn bị dữ liệu
        $formattedQuizzes = $quizzes->map(function ($quiz) {
            $answers = [];

            // Kiểm tra và thêm các đáp án sai nếu có
            if ($quiz->wrong_answer1) $answers[] = $quiz->wrong_answer1;
            if ($quiz->wrong_answer2) $answers[] = $quiz->wrong_answer2;
            if ($quiz->wrong_answer3) $answers[] = $quiz->wrong_answer3;
            if ($quiz->correct_answer) $answers[] = $quiz->correct_answer;

            shuffle($answers); // Trộn các đáp án

            return [
                'question' => $quiz->question,
                'answers' => $answers,
                'correct_answer' => $quiz->correct_answer, // Đảm bảo truyền đúng correct_answer
            ];
        });

        // Trả về view với dữ liệu
        return view('video', ['quizzes' => $formattedQuizzes, 'video' => $id]);
    }
}