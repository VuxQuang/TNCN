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

        // Lấy các câu hỏi quiz liên quan (giả sử có liên kết giữa video và quiz)
        $quizzes = Quiz::all(); // Lấy toàn bộ quiz (hoặc chỉ quiz liên quan đến video nếu có liên kết)

        // Truyền dữ liệu vào view
        return view('video', compact('video', 'quizzes'));
    }
}
