@extends('layouts.app')

@section('content')
<div class="container">
    <h2>新しいレッスンを作成</h2>

    <!-- Form to create a new lesson and video -->
    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf

        <!-- Lesson details -->
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">説明</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <!-- Video details -->
        <div class="mb-3">
            <label for="youtube_link" class="form-label">Videoリンク</label>
            <input type="url" name="youtube_link" id="youtube_link" class="form-control" value="{{ old('youtube_link') }}" required>
        </div>

        <!-- Quizzes -->
        <h3>クイズ</h3>
        <div id="quizzes-container">
            <!-- No quizzes initially -->
        </div>

        <!-- Button to add new quiz -->
        <button type="button" class="btn btn-primary" id="add-quiz-btn">クイズを追加</button>

        <!-- Submit button -->
        <div class="mt-3">
            <button type="submit" class="btn btn-success">レッスンを作成</button>
        </div>
    </form>
</div>

<script>
    let quizIndex = 0;
    
    document.getElementById('add-quiz-btn').addEventListener('click', function() {
        let container = document.getElementById('quizzes-container');
        let newQuiz = document.createElement('div');
        newQuiz.className = 'mb-3 quiz';
        newQuiz.setAttribute('data-index', quizIndex);
        newQuiz.innerHTML = `
            <label class="form-label">質問 ${quizIndex + 1}</label>
            <input type="text" name="questions[${quizIndex}][question]" class="form-control" required>
            
            <label class="form-label">回答</label>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control mb-2" required>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control mb-2" required>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control mb-2" required>
            <label class="form-label">正しい回答</label>
            <input type="text" name="questions[${quizIndex}][answers][]" class="form-control mb-2" required>
            
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
