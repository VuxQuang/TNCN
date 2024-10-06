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
use App\Http\Controllers\VocabularyController;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\VocabController;
use App\Http\Controllers\SearchController;
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
// Route::get('/video/{lesson_id}', [VideoController::class, 'show'])->name('video.show');


Route::get('/quiz/{id}', [QuizController::class, 'show']);
// Route cho hồ sơ
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Route cho cài đặt
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Route::get('/', function () {
//     // Truy vấn tất cả các bài học từ bảng lessons
//     $lessons = Lesson::all();

//     // Truyền dữ liệu vào view 'welcome'
//     return view('welcome', compact('lessons'));
// });
Route::get('/', [WelcomeController::class, 'index']);
Route::post('/submit-answer', [QuizController::class, 'submitAnswer']);

// CRUD routes for lesson management
Route::get('/qlLesson', [LessonController::class, 'showLessonsForManagement'])->name('qlLesson');
Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

Route::get('/video/{lessonId}', [VideoController::class, 'show']);

Route::post('/submit-answer', [VideoController::class, 'submitAnswer'])->name('submit.answer');
Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::get('/vocab', [VocabController::class, 'index'])->name('vocab');
Route::delete('/vocab/{id}', [VocabController::class, 'destroy'])->name('vocab.destroy');
Route::put('/vocab/{id}', [VocabController::class, 'update'])->name('vocab.update');
Route::post('/vocab', [VocabController::class, 'store'])->name('vocab.store');

Route::delete('/account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');


Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/story', function () {
    return view('story.story');
})->name('story.page');
