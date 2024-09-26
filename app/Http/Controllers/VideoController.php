<?php
namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Quiz;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($lessonId)
    {
        // Fetch the video associated with the given lesson ID
        $video = Video::where('lesson_id', $lessonId)->firstOrFail(); // Fetch video by lesson_id
    
        // Fetch quizzes related to the video using video_id
        $quizzes = Quiz::where('video_id', $video->id)->get()->map(function ($quiz) {
            // Create an array of answers
            $answers = [
                $quiz->wrong_answer1,
                $quiz->wrong_answer2,
                $quiz->wrong_answer3,
                $quiz->correct_answer,
            ];
    
            // Shuffle the answers
            shuffle($answers);
    
            // Return quiz data with shuffled answers
            return [
                'question'       => $quiz->question,
                'answers'        => $answers,
                'correct_answer' => $quiz->correct_answer,
            ];
        });
    
        // Return the view with the video and quizzes data
        return view('video', [
            'video'   => $video,
            'quizzes' => $quizzes,
        ]);
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
