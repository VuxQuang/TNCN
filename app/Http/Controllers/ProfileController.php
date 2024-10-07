<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Hiển thị trang chỉnh sửa Profile
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        return view('profile', compact('user'));
    }

    // Cập nhật thông tin Profile
    public function update(Request $request)
{
    // Kiểm tra và xác thực dữ liệu
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        // thêm các trường hợp khác nếu cần
    ]);

    // Cập nhật thông tin người dùng
    $user = Auth::user();
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    // Cập nhật các trường khác nếu cần
    $user->save();

    return redirect()->route('profile')->with('success', 'プロフィールが正常に更新されました');
}


}
