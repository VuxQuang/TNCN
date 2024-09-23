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

    <!-- Hiển thị video -->
    <div>
        <iframe width="1000" height="500" src="https://www.youtube.com/embed/{{ explode('v=', $video->url)[1] }}" frameborder="0" allowfullscreen></iframe>
    </div>

    <!-- Hiển thị các câu hỏi quiz -->
    <h2>Các câu hỏi quiz</h2>
    <div class="container">
        <!-- Carousel không tự động chuyển -->
        <div id="carouselExampleInterval" class="carousel slide">
            <div class="carousel-inner">
                @forelse ($quizzes as $index => $quiz)
                    <div class="carousel-item @if($index == 0) active @endif">
                        <div class="card quiz">
                            <div class="card-body">
                                <h5 class="card-title title"><strong>{{ $quiz['question'] }}</strong></h5>
                                <ul class="anss">
                                    @foreach ($quiz['answers'] as $answer)
                                        <li class="ans" style="background-color:{{ $loop->index == 3 ? 'rgb(10, 209, 86)' : ($loop->index == 0 ? 'aqua' : ($loop->index == 1 ? 'rgb(231, 118, 12)' : 'rgb(201, 33, 41)')) }}"
                                            onclick="submitAnswer(this, '{{ $answer }}', '{{ $quiz['question'] }}', {{ $loop->index == 3 }})">
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
            <!-- Hiển thị số câu đã làm trên tổng số câu -->
            <div class="position-relative mt-3">
                <span class="position-absolute top-0 start-50 translate-middle-x">
                    <strong id="question-counter">1/{{ count($quizzes) }}</strong>
                </span>
            </div>
        </div>
    </div>

    <!-- Hiển thị kết quả sau khi hoàn thành quiz -->
    <div id="result" style="display:none;">
        <h4>Kết quả của bạn: <span id="correct-answers"></span> / {{ count($quizzes) }}</h4>
    </div>
    
    @endsection
</body>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let correctCount = 0; // Đếm số câu trả lời đúng
    let answeredCount = 0; // Đếm số câu đã trả lời
    const totalQuestions = {{ count($quizzes) }}; // Tổng số câu hỏi

    function submitAnswer(element, answer, question, isCorrect) {
        // Disable all answers for this question to prevent multiple selections
        const parentUl = element.closest('ul');
        const allAnswers = parentUl.querySelectorAll('.ans');
        allAnswers.forEach(ans => {
            ans.style.pointerEvents = 'none';  // Disable clicks on all answers
        });

        // Kiểm tra câu trả lời đúng/sai
        if (isCorrect) {
            correctCount++; // Tăng số câu trả lời đúng
            element.style.border = '5px solid green';  // Highlight the correct answer
        } else {
            element.style.border = '5px solid red';  // Highlight the wrong answer
        }

        answeredCount++; // Tăng số câu đã trả lời

        // Cập nhật bộ đếm số câu đã làm
        updateQuestionCounter(answeredCount, totalQuestions);

        // Tự động chuyển câu hỏi sau khi chọn đáp án
        setTimeout(() => {
            if (answeredCount === totalQuestions) {
                showResult(); // Hiển thị kết quả khi trả lời xong tất cả các câu hỏi
            } else {
                // Chuyển sang câu hỏi tiếp theo
                const nextButton = document.querySelector('.carousel-control-next');
                nextButton.click();
            }
        }, 500);  // Delay 1 giây trước khi chuyển câu hỏi
    }

    // Cập nhật bộ đếm câu hỏi
    function updateQuestionCounter(answered, total) {
        const counterElement = document.getElementById('question-counter');
        counterElement.textContent = `${answered}/${total}`;
    }

    // Hiển thị kết quả sau khi hoàn thành tất cả các câu hỏi
    function showResult() {
        document.getElementById('correct-answers').innerText = correctCount;
        document.getElementById('result').style.display = 'block'; // Hiển thị kết quả
    }
</script>

</html>
