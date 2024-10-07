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
    // Lấy số từ vựng từ cài đặt của người dùng hoặc mặc định là 10
    $dailyVocab = Auth::check() ? Auth::user()->daily_vocab : 10;

    // Lấy $dailyVocab từ vựng ngẫu nhiên
    $vocabulary = Vocabulary::inRandomOrder()->limit($dailyVocab)->get();
    $isLoggedIn = Auth::check();

    // Lấy tất cả bài học
    $lessons = Lesson::paginate(9);
    
    // Truyền dữ liệu vào view
    return view('welcome', compact('vocabulary', 'lessons', 'isLoggedIn', 'dailyVocab'));
}

    
}
