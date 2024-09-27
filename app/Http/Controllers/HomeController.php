<?php

namespace App\Http\Controllers;
use App\Models\Vocabulary;
use App\Models\Lesson;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Lấy 10 từ vựng ngẫu nhiên
        $vocabulary = Vocabulary::inRandomOrder()->limit(10)->get();
        
        // Lấy tất cả bài học
        $lessons = Lesson::paginate(9);
        
        // Truyền dữ liệu vào view
        return view('welcome', compact('vocabulary', 'lessons'));
    }
}
