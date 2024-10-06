<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <h1>{{ $video->title }}</h1>
    <h2>{{ $video->description }}</h2>

    <!-- Video display -->
    <div>
        <iframe id="video-frame" width="1000" height="500" src="https://www.youtube.com/embed/{{ explode('v=', $video->url)[1] }}" frameborder="0" allowfullscreen></iframe>
    </div>

    <body>
        <div class="lesson-quizz">
            <div class="quiz-container">
                <div id="question-number" class="question-number">質問 1/10</div> <!-- Hiển thị số thứ tự câu hỏi -->
    
                @foreach($quizzes as $index => $quiz)
                    <div class="slides" data-correct-answer="{{ $quiz['correct_answer'] }}">
                        <div class="question">{{ $quiz['question'] }}</div>
                        <div class="answers">
                            @foreach($quiz['answers'] as $answer)
                                <div class="answer">{{ $answer }}</div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
    
                <!-- Navigation buttons -->
                <div class="navigation">
                    <button class="nav-button" id="prevBtn" disabled>前へ</button> <!-- Previous -->
                    <button class="nav-button" id="nextBtn">次へ</button> <!-- Next -->
                </div>
    
                <!-- Results -->
                <div class="results">
                    あなたは <span id="correct-count"></span> 正解しました / <span id="total-questions"></span> 問題中！ <!-- You got ... correct out of ... questions! -->
                    <p id="result-message"></p>
                    <span id="close-btn" style="cursor: pointer;font-weight: bold;position: absolute;right: 9px;"><i class="fa-solid fa-xmark"></i></span>
                    @if($nextLessonId)
                    <a href="{{ url('video/' . $nextLessonId) }}" class="btn btn-primary hover">次のレッスンへ</a> <!-- Học tiếp -->
                    @endif
                    
                    @if($noNextLessonMessage)
                        <div class="alert alert-warning" role="alert">
                            {{ $noNextLessonMessage }}
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    
    </body>

    @endsection
</body>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/video-tracker.js') }}"></script>
<script src="https://www.youtube.com/iframe_api"></script>
<script>
    
</script>
</html>
