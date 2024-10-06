<?php
namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Lesson;

class VideoController extends Controller
{
    public function show($lessonId)
{
    // Fetch the video associated with the given lesson ID
    $video = Video::where('lesson_id', $lessonId)->firstOrFail();

    // Fetch quizzes related to the video using video_id
    $quizzes = Quiz::where('video_id', $video->id)->get()->map(function ($quiz) {
        $answers = [
            $quiz->wrong_answer1,
            $quiz->wrong_answer2,
            $quiz->wrong_answer3,
            $quiz->correct_answer,
        ];

        shuffle($answers);

        return [
            'question'       => $quiz->question,
            'answers'        => $answers,
            'correct_answer' => $quiz->correct_answer,
        ];
    });

    // Get next lesson ID
    $nextLessonId = Lesson::where('id', '>', $lessonId)
                           ->orderBy('id')
                           ->pluck('id')
                           ->first();

    // Prepare the message if no next lesson exists
    $noNextLessonMessage = !$nextLessonId ? 'すべてのレッスンを完了しました。' : '';

    // Return the view with the video, quizzes, next lesson ID, and message
    return view('video', [
        'video'   => $video,
        'quizzes' => $quizzes,
        'nextLessonId' => $nextLessonId,
        'noNextLessonMessage' => $noNextLessonMessage,
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
