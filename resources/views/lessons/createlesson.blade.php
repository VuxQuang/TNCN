@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Lesson</h2>

    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Lesson</button>
        <a href="{{ route('qlLesson') }}" class="btn btn-secondary mt-3">Back to Lesson Management</a>
    </form>
</div>
@endsection
