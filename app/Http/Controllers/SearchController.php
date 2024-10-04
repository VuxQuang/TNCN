<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page');

        // Tìm kiếm cho trang Lesson Management
        if ($page === 'qlLesson') {
            $results = Lesson::where('title', 'LIKE', "%$query%")
                        ->orWhere('description', 'LIKE', "%$query%")
                        ->get();
        }
        // Tìm kiếm cho trang Danh sách từ vựng
        elseif ($page === 'vocab') {
            $results = Vocabulary::where('word', 'LIKE', "%$query%")
                        ->orWhere('meaning', 'LIKE', "%$query%")
                        ->get();
        } else {
            $results = collect(); // Trả về danh sách trống nếu không xác định được trang
        }

        return view('searchresults', compact('results', 'page'));
    }
}
