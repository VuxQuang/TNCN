<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Giả sử bạn có một cột để lưu số từ vựng hàng ngày của người dùng
        $dailyVocab = $user->daily_vocab ?? 10; // Giá trị mặc định là 10 nếu không có

        return view('welcome', compact('dailyVocab'));
    }

    public function saveSettings(Request $request)
{
    $request->validate([
        'daily_vocab' => 'required|integer|min:1',
    ]);

    $user = Auth::user();
    $user->daily_vocab = $request->input('daily_vocab');
    $user->save();

    // Redirect về route gốc sau khi lưu cài đặt
    return redirect('/')->with('success', '設定が正常に更新されました。');
}

}
