<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;
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
    // Validate dữ liệu đầu vào từ form
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'youtube_link' => 'required|url',
        'questions' => 'required|array',
        'questions.*.question' => 'required|string',
        'questions.*.answers' => 'required|array|min:2|max:4',
        'questions.*.answers.*' => 'required|string',
        'questions.*.answers' => 'required|array|min:2|max:4',
        'questions.*.answers.*' => 'required|string',
        'questions.*.answers.*' => 'required|string',
    ]);

    // Tạo một bài học mới và lưu vào cơ sở dữ liệu
    $lesson = new Lesson();
    $lesson->title = $validated['title'];
    $lesson->description = $validated['description'];
    $lesson->save(); // Lưu bài học

    // Tạo một video mới liên kết với bài học
    $video = new Video();
    $video->url = $validated['youtube_link']; // Lấy link từ form
    $video->title = $validated['title']; // Lấy title từ bài học
    $video->description = $validated['description']; // Lấy description từ bài học
    $video->lesson_id = $lesson->id; // Lấy id của bài học vừa tạo và gán vào cột lesson_id
    $video->save(); // Lưu video

    // Xử lý dữ liệu quiz và lưu vào cơ sở dữ liệu
    foreach ($validated['questions'] as $questionData) {
        Quiz::create([
            'question' => $questionData['question'],
            'wrong_answer1' => $questionData['answers'][0] ?? null,
            'wrong_answer2' => $questionData['answers'][1] ?? null,
            'wrong_answer3' => $questionData['answers'][2] ?? null,
            'correct_answer' => $questionData['answers'][3] ?? null,
            'video_id' => $video->id, // Liên kết quiz với video vừa tạo
        ]);
    }

    // Chuyển hướng người dùng về trang quản lý bài học với thông báo thành công
    return redirect()->route('qlLesson')->with('success', 'レッスン、ビデオ、およびクイズが正常に作成されました。');
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
    
        return redirect()->route('qlLesson')->with('success', 'レッスンの更新に成功しました！');
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

        return redirect()->route('qlLesson')->with('success', 'レッスン、ビデオ、およびクイズは正常に削除されました。');
    }
}
