<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@extends('layouts.app')

@section('content')
    <h1>Lesson Management</h1>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">Add Lesson</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul class="lessons-card">
        @foreach ($lessons as $lesson)
            <li class="less-card">
                <h3 class="lessontitle">{{ $lesson->title }}</h3>
                <p class="lessond">{{ $lesson->description }}</p>
                <div class="edit-dele">
                    <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning edit-btn">Edit</a>
                    <form class="delete-form" action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    <!-- Pagination Links -->
    <div class="pagination-links">
        {{ $lessons->links() }}
    </div>
@endsection

