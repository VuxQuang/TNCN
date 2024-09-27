<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;

class VocabularyController extends Controller
{
    public function index()
    {
        // Lấy 10 từ vựng ngẫu nhiên từ cơ sở dữ liệu
        $vocabulary = Vocabulary::inRandomOrder()->limit(10)->get();

        // Truyền dữ liệu vào view 'welcome'
        return view('welcome', compact('vocabulary'));
    }
}
