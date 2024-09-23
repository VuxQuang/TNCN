<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>

    <!-- Video display -->
    <div>
        <iframe id="video-frame" width="1000" height="500" src="https://www.youtube.com/embed/{{ explode('v=', $video->url)[1] }}" frameborder="0" allowfullscreen></iframe>

    </div>


    <!-- Quiz questions -->
    <h2>Các câu hỏi quiz</h2>
    <button id="enable-quiz" class="btn btn-primary" style="display: none;">Xem Video và Làm Quiz</button>
    <div class="container">
        <div id="carouselExampleInterval" class="carousel slide">
            <div class="carousel-inner">
                @forelse ($quizzes as $index => $quiz)
                    <div class="carousel-item @if($index == 0) active @endif">
                        <div class="card quiz" data-correct-answer="{{ $quiz['correct_answer'] }}">
                            <div class="card-body">
                                <h5 class="card-title title"><strong>{{ $quiz['question'] }}</strong></h5>
                                <ul class="anss">
                                    @foreach ($quiz['answers'] as $answer)
                                        <li class="ans"
                                            style="background-color:{{ $loop->index == 3 ? 'rgb(10, 209, 86)' : ($loop->index == 0 ? 'aqua' : ($loop->index == 1 ? 'rgb(231, 118, 12)' : 'rgb(201, 33, 41)')) }}"
                                            onclick="submitAnswer(this, '{{ $answer }}', '{{ $quiz['question'] }}')">
                                            {{ $answer }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No quizzes available</p>
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Question counter -->
            <div class="position-relative mt-3">
                <span class="position-absolute top-0 start-50 translate-middle-x">
                    <strong id="question-counter">1/{{ count($quizzes) }}</strong>
                </span>
            </div>
        </div>
    </div>

  <!-- Quiz result -->
<div id="result" style="display:none;">
    <h4>Kết quả của bạn: <span id="correct-answers"></span> / {{ count($quizzes) }}</h4>
</div>

<!-- Thông báo hoàn thành tốt -->
<div id="completion-message" style="display:none;">
    <!-- Nội dung sẽ được cập nhật bằng JavaScript -->
</div>


    @endsection
</body>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/video-tracker.js') }}"></script>
<script src="https://www.youtube.com/iframe_api"></script>


</html>
