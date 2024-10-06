@extends('layouts.app')

@section('content')
<div class="container">
    <h2>レッスン修正</h2>

    <!-- Form to edit the lesson and video -->
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Lesson details -->
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control set" value="{{ old('title', $lesson->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">説明</label>
            <textarea name="description" id="description" class="form-control set" required>{{ old('description', $lesson->description) }}</textarea>
        </div>

        <!-- Video details -->
        <div class="mb-3">
            <label for="youtube_link" class="form-label">Videoリンク</label>
            <input type="url" name="youtube_link" id="youtube_link" class="form-control set" value="{{ old('youtube_link', $video->url) }}" required>
        </div>

        <!-- Quizzes -->
        <h3>クイズ</h3>
        <div id="quizzes-container">
            @foreach($quizzes as $index => $quiz)
                <div class="mb-3 quiz" data-index="{{ $index }}">
                    <label class="form-label">質問 {{ $index + 1 }}</label>
                    <input type="text" name="questions[{{ $index }}][question]" class="form-control set" value="{{ old('questions.' . $index . '.question', $quiz->question) }}" required>
                    
                    <label class="form-label">回答</label>
                    <input type="text" name="questions[{{ $index }}][answers][]" class="form-control set mb-2" value="{{ old('questions.' . $index . '.answers.0', $quiz->wrong_answer1) }}" required>
                    <input type="text" name="questions[{{ $index }}][answers][]" class="form-control set mb-2" value="{{ old('questions.' . $index . '.answers.1', $quiz->wrong_answer2) }}" required>
                    <input type="text" name="questions[{{ $index }}][answers][]" class="form-control set mb-2" value="{{ old('questions.' . $index . '.answers.2', $quiz->wrong_answer3) }}" required>
                    <label class="form-label">正しい回答</label>
                    <input type="text" name="questions[{{ $index }}][answers][]" class="form-control set mb-2" value="{{ old('questions.' . $index . '.answers.3', $quiz->correct_answer) }}" required>
                    
                    <!-- Button to remove quiz -->
                    <button type="button" class="btn btn-danger mt-2" onclick="removeQuiz(this)">削除</button>
                </div>
            @endforeach
        </div>

        <!-- Button to add new quiz -->
        <button type="button" class="btn btn-primary" id="add-quiz-btn">クイズを追加</button>

        <!-- Submit button -->
        <div class="mt-3">
            <button type="submit" class="btn btn-success">レッスンを更新</button>
        </div>
    </form>
</div>

<script>
    let quizIndex = {{ count($quizzes) }};
    
    document.getElementById('add-quiz-btn').addEventListener('click', function() {
        let container = document.getElementById('quizzes-container');
        let newQuiz = document.createElement('div');
        newQuiz.className = 'mb-3 quiz';
        newQuiz.setAttribute('data-index', quizIndex);
        newQuiz.innerHTML = `
            <label class="form-label">質問 ${quizIndex + 1}</label>
            <input type="text" name="questions[${quizIndex}][question]" class="form-control set" required>
            
            <label class="form-label">回答</label>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control set mb-2" required>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control set mb-2" required>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control set mb-2" required>
            <label class="form-label">正しい回答</label>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control set mb-2" required>
            
            <button type="button" class="btn btn-danger mt-2" onclick="removeQuiz(this)">削除</button>
        `;
        container.appendChild(newQuiz);
        quizIndex++;
    });

    function removeQuiz(button) {
        button.parentElement.remove();
    }
</script>
@endsection
