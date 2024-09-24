@extends('layouts.app')

@section('content')
    <h1>Lesson Management</h1>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">Add Lesson</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($lessons as $lesson)
            <li>
                <h3>{{ $lesson->title }}</h3>
                <p>{{ $lesson->description }}</p>
                <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
