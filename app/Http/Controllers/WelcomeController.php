<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;
use App\Models\Lesson;

class WelcomeController extends Controller
{
    public function index()
    {
        // Lấy 10 từ vựng ngẫu nhiên
        $vocabulary = Vocabulary::inRandomOrder()->limit(10)->get();
        
        // Lấy tất cả bài học
        $lessons = Lesson::all();
        
        // Truyền dữ liệu vào view
        return view('welcome', compact('vocabulary', 'lessons'));
    }
}
