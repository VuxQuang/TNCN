@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vocabulary List</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Word</th>
                <th>Meaning</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vocabularies as $vocabulary)
                <tr>
                    <td>{{ $vocabulary->id }}</td>
                    <td>
                        <form action="{{ route('vocab.update', $vocabulary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="word" value="{{ $vocabulary->word }}" required>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('vocab.update', $vocabulary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="meaning" value="{{ $vocabulary->meaning }}" required>
                        </form>
                    </td>
                    <td>
                        <button type="submit" form="{{ $vocabulary->id }}" class="btn btn-primary">Update</button>
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

    <!-- Nút thêm từ vựng -->
    <button id="add-vocab-btn" class="btn btn-success">Add Vocab</button>

    <!-- Form thêm từ vựng -->
    <form id="add-vocab-form" action="{{ route('vocab.store') }}" method="POST" style="display:none; margin-top: 20px;">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="word" class="form-control" placeholder="Word" required>
            <input type="text" name="meaning" class="form-control" placeholder="Meaning" required>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('add-vocab-btn').addEventListener('click', function() {
        var form = document.getElementById('add-vocab-form');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
</script>


@endsection
