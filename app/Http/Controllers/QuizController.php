<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Video;

class QuizController extends Controller
{
    public function show($id)
    {
        // Get quizzes related to the video
        $quizzes = Quiz::where('video_id', $id)->get();

        // Format the quizzes
        $formattedQuizzes = $quizzes->map(function ($quiz) {
            $answers = [
                $quiz->answer1,
                $quiz->answer2,
                $quiz->answer3,
                $quiz->answer4,
            ];

            // Shuffle the answers
            shuffle($answers);

            return [
                'question' => $quiz->question,
                'answers' => $answers,
                'correct_answer' => $quiz->correct_answer, // Pass correct answer index
            ];
        });

        return view('video', ['quizzes' => $formattedQuizzes, 'video' => $id]);
    }
    // public function edit(Quiz $quiz)
    // {
    //     // Find the video associated with the quiz
    //     $video = Video::findOrFail($quiz->video_id);
    
    //     // Retrieve all quizzes related to the video
    //     $quizzes = Quiz::where('video_id', $video->id)->get();
    
    //     // Return the view with the required data
    //     return view('quizzes.edit', compact('quiz', 'video', 'quizzes'));
    // }
    // public function update(Request $request, Quiz $quiz)
    // {
    //     // Validate dữ liệu
    //     $request->validate([
    //         'question' => 'required',
    //         'answers' => 'required|array',
    //         'correct_answer_index' => 'required|integer|between:0,3',
    //     ]);

    //     // Cập nhật thông tin quiz
    //     $quiz->question = $request->question;
    //     $quiz->answer1 = $request->answers[0];
    //     $quiz->answer2 = $request->answers[1];
    //     $quiz->answer3 = $request->answers[2];
    //     $quiz->answer4 = $request->answers[3];
    //     $quiz->correct_answer_index = $request->correct_answer_index;
    //     $quiz->save();

    //     return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    // }


}
