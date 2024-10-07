<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Vihongo') }}</title>

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
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Vihongo') }}
            </a>
            @if(Auth::check() && Auth::user()->email === 'raijin2306@gmail.com')
            <a class="lesson" href="{{ url('/qlLesson') }}">
                    {{ __('レッスン') }}
            </a>
            <a class="lesson" href="{{ url('/account') }}">
                {{ __('アカウント') }}
            </a>
            <a class="lesson" href="{{ url('/vocab') }}">
                {{ __('語彙') }}
            </a>
            @endif    
            <a class="lesson" href="{{ asset('story.html') }}">物語</a>
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <!-- Thanh tìm kiếm -->
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form class="d-flex" action="{{ url('/search') }}" method="GET">
                            <input class="form-control me-2" type="search" name="query" placeholder="検索" aria-label="Search">
                            
                            <!-- Trường ẩn để biết trang tìm kiếm -->
                            @if (Request::is('qlLesson'))
                                <input type="hidden" name="page" value="qlLesson">
                            @elseif (Request::is('vocab'))
                                <input type="hidden" name="page" value="vocab">
                            @endif
                        
                            <button class="btn btn-outline-success" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>                        
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('履歴書') }}
                                </a>
                                <a class="dropdown-item" href="#" id="settings-btn">
                                    {{ __('設定') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
<!-- Thẻ settings -->
<!-- Thẻ settings -->
<form id="settings-form" action="{{ route('settings.save') }}" method="POST">
    <div id="settings-card" class="card" style="display: none; align-items: center; flex-wrap: wrap; position: absolute; z-index: 2; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 400px; border-radius: 30px; width: 500px;box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.146);">
        <div class="card-header" style="background-color: white;">
            設定
        </div>
        <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; flex-direction: column; width: 100%; font-size: 25px; border-radius: 30px;">
            <form id="settings-form" action="{{ route('settings.save') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="dark_theme">ダークテーマ</label>
                    <input type="checkbox" id="dark_theme" name="dark_theme">
                </div>

                <div class="form-group" style="width: 59%;">
                    <label for="language">言語</label>
                    <select id="language" name="language" class="form-control">
                        <option value="jp">日本語</option>
                        <option value="vn">Tiếng Việt</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="daily_vocab">毎日の語彙数</label>
                    <input type="number" id="daily_vocab" name="daily_vocab" value="{{ isset($dailyVocab) ? $dailyVocab : 10 }}" class="form-control" min="1">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">保存</button>
                    <button type="button" id="cancel-btn" class="btn btn-secondary">キャンセル</button>
                </div>
            </form>
        </div>
    </div>
</form>


    <main class="py-4">
        @yield('content')
    </main>
</body>
<script>
    document.getElementById('settings-btn').addEventListener('click', function() {
        document.getElementById('settings-card').style.display = 'flex';
    });

    document.getElementById('cancel-btn').addEventListener('click', function() {
        document.getElementById('settings-card').style.display = 'none';
    });
</script>

</html>
