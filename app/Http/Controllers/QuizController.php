<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
{
    // Lấy tất cả các quiz
    $quizzes = Quiz::all();

    // Kiểm tra dữ liệu và xử lý
    $formattedQuizzes = $quizzes->map(function($quiz) {
        $answers = [];

        // Kiểm tra từng đáp án có tồn tại
        if ($quiz->wrong_answer1) $answers[] = $quiz->wrong_answer1;
        if ($quiz->wrong_answer2) $answers[] = $quiz->wrong_answer2;
        if ($quiz->wrong_answer3) $answers[] = $quiz->wrong_answer3;
        if ($quiz->correct_answer) $answers[] = $quiz->correct_answer;

        shuffle($answers); // Trộn các đáp án

        return [
            'question' => $quiz->question,
            'answers' => $answers, // Trả về các đáp án đã trộn
        ];
    });

    // Trả về view với dữ liệu đã kiểm tra
    return view('video', ['quizzes' => $formattedQuizzes]);
}

}
