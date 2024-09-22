
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vinhongo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>

<body>
    @extends('layouts.app')

    @section('content')
        
        <div  class="daily" >
            <div class="tuvung">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-bs-interval="10000">
                            <h1>Xin chaof</h1>
                            <h2>konichiha</h2>
                      </div>
                      <div class="carousel-item" data-bs-interval="2000">
                            <h1>Tan biet</h1>
                            <h2>konichiha</h2>
                      </div>
                      <div class="carousel-item">
                            <h1>chao buoi sang</h1>
                            <h2>konichiha</h2>
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    
        <div class="Lessons">
            <h1>Lessons</h1>
            <div class="lessons-view">
                @foreach($lessons as $lesson)
                    <a href="{{ url('video/'.$lesson->id) }}" class="lesson-card">
                        <div class="lesson-card">
                            <h1>{{ $lesson->title }}</h1> <!-- Hiển thị tiêu đề bài học -->
                            <h2>{{ $lesson->description }}</h2> <!-- Hiển thị mô tả bài học -->
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        
    @endsection
    
</body>
</html>
