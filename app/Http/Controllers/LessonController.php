<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // Hiển thị tất cả các bài học trên trang welcome
    public function index()
    {
        $lessons = Lesson::all();
        return view('welcome', compact('lessons'));
    }

    // Hiển thị danh sách các bài học cho trang quản lý bài học (QlLesson)
    public function showLessonsForManagement()
    {
        $lessons = Lesson::all();
        return view('qlLesson', compact('lessons'));
    }

    // Hiển thị form tạo bài học mới
    public function create()
    {
        return view('lessons.createlesson');
    }

    // Lưu bài học mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Lesson::create($request->all());
        return redirect()->route('qlLesson')->with('success', 'Lesson created successfully.');
    }

    // Hiển thị form chỉnh sửa bài học
    public function edit(Lesson $lesson)
    {
        return view('lessons.editlesson', compact('lesson'));
    }

    // Cập nhật thông tin bài học
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $lesson->update($request->all());
        return redirect()->route('qlLesson')->with('success', 'Lesson updated successfully.');
    }

    // Xóa bài học
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('qlLesson')->with('success', 'Lesson deleted successfully.');
    }
}
