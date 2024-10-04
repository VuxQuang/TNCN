@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kết quả tìm kiếm</h1>

        @if($page === 'qlLesson')
        <ul class="lessons-card">
        @foreach($results as $lesson)
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
    @elseif($page === 'vocab')
    <div class="container vocab">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Từ vựng</th>
                    <th>Ý nghĩa</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $vocabulary)
                    <tr>
                        <form action="{{ route('vocab.update', $vocabulary->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td>{{ $vocabulary->id }}</td>
                            <td>
                                <input type="text" name="word" value="{{ $vocabulary->word }}" required>
                            </td>
                            <td>
                                <input type="text" name="meaning" value="{{ $vocabulary->meaning }}" required>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </td>
                        </form>
                        <td>
                            <form action="{{ route('vocab.destroy', $vocabulary->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No results found.</p>
    @endif
</div>
@endsection