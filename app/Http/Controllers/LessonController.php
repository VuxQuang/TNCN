<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        // Truy vấn tất cả các bài học từ bảng lessons
        $lessons = Lesson::all();

        // Truyền dữ liệu vào view
        return view('welcome', compact('lessons'));
    }
}

