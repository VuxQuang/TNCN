<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }}</title>
</head>
<body>
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>

    <!-- Hiển thị video -->
    <div>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ explode('v=', $video->url)[1] }}" frameborder="0" allowfullscreen></iframe>
    </div>

    <!-- Hiển thị các câu hỏi quiz -->
    <h2>Các câu hỏi quiz</h2>
    <div>
        @foreach ($quizzes as $quiz)
            <div class="quiz">
                <p><strong>{{ $quiz->question }}</strong></p>
                <ul>
                    <li>{{ $quiz->wrong_answer1 }}</li>
                    <li>{{ $quiz->wrong_answer2 }}</li>
                    <li>{{ $quiz->wrong_answer3 }}</li>
                    <li>{{ $quiz->correct_answer }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</body>
</html>
