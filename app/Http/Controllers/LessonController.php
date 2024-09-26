<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Quiz;
class LessonController extends Controller
{
    // Hiển thị tất cả các bài học trên trang welcome
    public function index()
    {
        $lessons = Lesson::paginate(9);
        return view('welcome', compact('lessons'));
    }

    // Hiển thị danh sách các bài học cho trang quản lý bài học (QlLesson)
    public function showLessonsForManagement()
    {
        $lessons = Lesson::paginate(9);
        return view('qlLesson', compact('lessons'));
    }

    // Hiển thị form tạo bài học mới
    public function create()
    {
        return view('lessons.createlesson');
    }

    // Lưu bài học mới
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'youtube_link' => 'required|url',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.answers' => 'required|array|min:2|max:4',
            'questions.*.correct_answer_index' => 'required|integer|between:0,3',
        ]);
    
        // Create a new lesson
        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        // Create a new video linked to the lesson
        $video = Video::create([
            'url' => $request->youtube_link,
            'title' => $request->title,
            'description' => $request->description,
            'lesson_id' => $lesson->id,
        ]);
    
        // Create quizzes linked to the video
        foreach ($request->questions as $questionData) {
            Quiz::create([
                'question' => $questionData['question'],
                'wrong_answer1' => $questionData['answers'][0] ?? null,
                'wrong_answer2' => $questionData['answers'][1] ?? null,
                'wrong_answer3' => $questionData['answers'][2] ?? null,
                'correct_answer' => $questionData['answers'][$questionData['correct_answer_index']] ?? null,
                'video_id' => $video->id,
            ]);
        }
    
        return redirect()->route('qlLesson')->with('success', 'Lesson, video, and quizzes created successfully');
    }
    
    
    // Hiển thị form chỉnh sửa bài học
    public function edit(Lesson $lesson)
    {
        // Tìm video liên quan tới bài học
        $video = Video::where('lesson_id', $lesson->id)->first();

        // Lấy tất cả các quiz liên quan đến video nếu video tồn tại
        $quizzes = $video ? Quiz::where('video_id', $video->id)->get() : collect();

        return view('lessons.editlesson', compact('lesson', 'video', 'quizzes'));
    }

    // Cập nhật thông tin bài học
    public function update(Request $request, $id)
    {
        // Tìm bài học (lesson) theo ID
        $lesson = Lesson::findOrFail($id);
    
        // Cập nhật thông tin bài học
        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->save();
    
        // Cập nhật thông tin video liên quan đến lesson
        $video = Video::where('lesson_id', $lesson->id)->first(); // Lấy video liên quan
        if ($video) {
            $video->url = $request->input('youtube_link'); // Cập nhật URL video
            $video->save();
        } else {
            // Nếu không tìm thấy video liên quan, bạn có thể tạo mới một video
            // hoặc xử lý theo nhu cầu của bạn.
        }
    
        // Xóa các quiz cũ liên quan đến video
        $videoId = $video->id ?? null;
        Quiz::where('video_id', $videoId)->delete();
    
        // Cập nhật hoặc tạo mới quiz
        $quizzes = $request->input('questions');
        foreach ($quizzes as $quiz) {
            if (isset($quiz['id'])) {
                // Cập nhật quiz hiện tại
                $existingQuiz = Quiz::find($quiz['id']);
                if ($existingQuiz) {
                    $existingQuiz->question = $quiz['question'];
                    $existingQuiz->wrong_answer1 = $quiz['answers'][0] ?? '';
                    $existingQuiz->wrong_answer2 = $quiz['answers'][1] ?? '';
                    $existingQuiz->wrong_answer3 = $quiz['answers'][2] ?? '';
                    $existingQuiz->correct_answer = $quiz['answers'][3] ?? '';
                    $existingQuiz->save();
                }
            } else {
                // Tạo quiz mới
                Quiz::create([
                    'question' => $quiz['question'],
                    'wrong_answer1' => $quiz['answers'][0] ?? '',
                    'wrong_answer2' => $quiz['answers'][1] ?? '',
                    'wrong_answer3' => $quiz['answers'][2] ?? '',
                    'correct_answer' => $quiz['answers'][3] ?? '',
                    'video_id' => $videoId, // Đảm bảo rằng videoId không phải là null
                ]);
            }
        }
    
        return redirect()->route('qlLesson')->with('success', 'Lesson updated successfully');
    }
    

    // Xóa bài học và các thông tin liên kết
    public function destroy(Lesson $lesson)
    {
        // Tìm video liên kết với bài học
        $video = Video::where('lesson_id', $lesson->id)->first();
        
        if ($video) {
            // Xóa tất cả các quiz liên quan đến video
            Quiz::where('video_id', $video->id)->delete();
            
            // Xóa video liên quan
            $video->delete();
        }

        // Xóa bài học
        $lesson->delete();

        return redirect()->route('qlLesson')->with('success', 'Lesson, video, and quizzes deleted successfully.');
    }
}
