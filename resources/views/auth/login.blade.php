@extends('layouts.app')

@section('content')
<div class="alert alert-danger" id="logout-success-notice" style="display: none;">
    <p style="font-size: 25px;">{{ session('logout_success') }}</p>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Đăng nhập') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ghi nhớ đăng nhập') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đăng nhập') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng kí') }}</a>
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Quên mật khẩu?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                            <a href="{{route('auth.google')}}">
                            <img src ="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                            </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif

<!-- Form đăng nhập -->
<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Các trường đăng nhập -->
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutSuccessNotice = document.getElementById('logout-success-notice');

        if (logoutSuccessNotice && logoutSuccessNotice.textContent.trim() !== '') {
            logoutSuccessNotice.style.display = 'block';

            // Ẩn thông báo sau 5 giây
            setTimeout(function () {
                logoutSuccessNotice.style.display = 'none';
            }, 5000); // 5000ms = 5 giây
        }
    });
</script>

@endsection
