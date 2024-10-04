<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use Illuminate\Http\Request;

class VocabController extends Controller
{
    public function index()
    {
        $vocabularies = Vocabulary::all(); // Lấy tất cả từ vựng từ bảng vocabulary
        return view('vocab', compact('vocabularies'));
    }

    public function edit($id)
    {
        $vocabulary = Vocabulary::findOrFail($id);
        return view('vocabedit', compact('vocabulary'));
    }

    public function destroy($id)
    {
        Vocabulary::destroy($id); // Xóa từ vựng theo ID
        return redirect()->route('vocab')->with('success', 'Đã xóa từ vựng thành công');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'word' => 'required|string|max:255',
            'meaning' => 'required|string|max:255',
        ]);

        $vocabulary = Vocabulary::findOrFail($id);
        $vocabulary->word = $request->word;
        $vocabulary->meaning = $request->meaning;
        $vocabulary->save();

        return redirect()->route('vocab')->with('success', 'Từ vựng được cập nhật thành công');
    }
    public function store(Request $request)
{
    $request->validate([
        'word' => 'required|string|max:255',
        'meaning' => 'required|string|max:255',
    ]);

    // Tạo từ vựng mới
    Vocabulary::create([
        'word' => $request->word,
        'meaning' => $request->meaning,
    ]);

    return redirect()->route('vocab')->with('success', 'Từ vựng được thêm thành công');
}

}

