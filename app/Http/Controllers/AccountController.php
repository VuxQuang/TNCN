<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng từ bảng users
        return view('account', compact('users'));
    }

    public function destroy($id)
    {
        User::destroy($id); // Xóa người dùng theo ID
        return redirect()->route('account')->with('success', 'ユーザーが正常に削除されました。');
    }
}
