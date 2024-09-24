<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        // Lấy 10 từ vựng ngẫu nhiên
        $vocabulary = Vocabulary::inRandomOrder()->limit(10)->get();
        $isLoggedIn = Auth::check();
        // Lấy tất cả bài học
        $lessons = Lesson::paginate(9);
        
        // Truyền dữ liệu vào view
        return view('welcome', compact('vocabulary', 'lessons','isLoggedIn'));
    }
}
