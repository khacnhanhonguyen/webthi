<!-- resources/views/giaovien/nopdethi.blade.php -->

@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Nộp Đề Thi</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('yeucaudethi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="ten_de_thi" class="form-label">Tên Đề Thi</label>
                <input type="text" class="form-control" name="ten" id="ten" required>
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô Tả</label>
                <textarea class="form-control" name="mo_ta" required></textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">File PDF</label>
                <input type="file" class="form-control" name="file" accept=".pdf" required>
            </div>

            <button type="submit" class="btn btn-primary">Nộp Đề Thi</button>
        </form>
    </div>
@endsection
