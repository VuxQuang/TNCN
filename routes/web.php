<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuizController;
use App\Models\Quiz;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LessonController;
use App\Models\Lesson;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/video/{id}', [VideoController::class, 'show']);
Route::get('/quiz/{id}', [QuizController::class, 'show']);
// Route cho hồ sơ
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Route cho cài đặt
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

Route::get('/', function () {
    // Truy vấn tất cả các bài học từ bảng lessons
    $lessons = Lesson::all();

    // Truyền dữ liệu vào view 'welcome'
    return view('welcome', compact('lessons'));
});
