@extends('layouts.app')

@section('content')
<div class="container vocab">
    <h1>語彙管理</h1> 
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <button id="add-vocab-btn" class="btn btn-success">語彙を追加</button> <!-- Thêm từ vựng -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>単語</th> <!-- Từ vựng -->
                <th>意味</th> <!-- Ý nghĩa -->
                <th>編集</th> <!-- Chỉnh sửa -->
            </tr>
        </thead>
        <tbody>
            @foreach($vocabularies as $vocabulary)
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
                            <button type="submit" class="btn btn-primary">修正</button> <!-- Sửa -->
                        </td>
                    </form>
                    <td>
                        <form action="{{ route('vocab.destroy', $vocabulary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button> <!-- Xóa -->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Nút thêm từ vựng -->
    

    <!-- Form thêm từ vựng -->
    <div class="add_vocab">
        <form id="add-vocab-form" action="{{ route('vocab.store') }}" method="POST" style="display:none; margin-top: 20px;">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="word" class="form-control" placeholder="単語" required> <!-- Word -->
                <input type="text" name="meaning" class="form-control" placeholder="意味" required> <!-- Meaning -->
                <button type="submit" class="btn btn-primary">追加</button> <!-- Thêm -->
            </div>
        </form>
    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('form.search-form').on('submit', function(e) {
            e.preventDefault(); // Ngăn không tải lại trang

            var query = $('input[name="query"]').val(); // Lấy giá trị tìm kiếm
            var page = $(this).data('page'); // Xác định trang hiện tại

            $.ajax({
                url: '{{ route('search') }}', // Đường dẫn tới route tìm kiếm
                type: 'GET',
                data: {
                    query: query,
                    page: page
                },
                success: function(response) {
                    var resultsContainer = $('#results'); // Phần tử chứa kết quả
                    resultsContainer.empty(); // Xóa kết quả cũ

                    if (response.length > 0) {
                        $.each(response, function(index, result) {
                            // Tạo HTML cho từng kết quả tìm kiếm
                            if (page === 'qlLesson') {
                                resultsContainer.append('<li>' + result.title + ' - ' + result.description + '</li>');
                            } else if (page === 'vocab') {
                                resultsContainer.append('<tr><td>' + result.word + '</td><td>' + result.meaning + '</td></tr>');
                            }
                        });
                    } else {
                        resultsContainer.append('<p>結果が見つかりませんでした</p>'); // No results found
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    });
</script>

@endsection
