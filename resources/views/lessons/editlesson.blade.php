@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Lesson</h2>

    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $lesson->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $lesson->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Lesson</button>
        <a href="{{ route('qlLesson') }}" class="btn btn-secondary mt-3">Back to Lesson Management</a>
    </form>
</div>
@endsection
