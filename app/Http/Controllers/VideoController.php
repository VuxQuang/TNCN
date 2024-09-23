<?php
namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Quiz;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($id)
    {
        // Lấy video theo ID
        $video = Video::findOrFail($id);

        // Lấy các câu hỏi quiz liên quan
        $quizzes = Quiz::all()->map(function ($quiz) {
            // Tạo mảng các câu trả lời
            $answers = [
                $quiz->wrong_answer1,
                $quiz->wrong_answer2,
                $quiz->wrong_answer3,
                $quiz->correct_answer,
            ];

            // Trộn các đáp án
            shuffle($answers);

            // Trả về dữ liệu quiz kèm theo các câu trả lời đã trộn và correct_answer
            return [
                'question'       => $quiz->question,
                'answers'        => $answers,
                'correct_answer' => $quiz->correct_answer, // Truyền thêm correct_answer
            ];
        });

        // Truyền dữ liệu vào view
        return view('video', compact('video', 'quizzes'));
    }

    public function submitAnswer(Request $request)
    {
        $answer = $request->input('answer');
        $question = $request->input('question');

        // Kiểm tra câu trả lời
        $quiz = Quiz::where('question', $question)->first();
        $correct = $quiz->correct_answer === $answer;

        return response()->json([
            'correct' => $correct
        ]);
    }
}
