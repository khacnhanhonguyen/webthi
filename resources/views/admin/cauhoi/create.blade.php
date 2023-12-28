<!-- resources/views/admin/cauhoi/create.blade.php -->

@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm Câu Hỏi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.cauhoi.store') }}">
            @csrf
            <input type="hidden" name="de_thi_id" value="{{ $de_thi_id }}">
            <div class="mb-3">
                <label for="de_thi_id" class="form-label">Đề thi:</label>
                <select class="form-control" name="de_thi_id" required>
                    <option value="{{ $deThi->id }}">{{ $deThi->tieu_de }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="noi_dung" class="form-label">Nội dung câu hỏi:</label>
                <textarea class="form-control summernote" name="noi_dung" required></textarea>
            </div>
            <div class="mb-3">
                <label for="cau_tra_lois" class="form-label">Câu trả lời:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dap_an_dung" value="0" checked>
                    <input type="text" class="form-control" name="cau_tra_lois[0][noi_dung]" placeholder="Câu trả lời 1" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dap_an_dung" value="1">
                    <input type="text" class="form-control" name="cau_tra_lois[1][noi_dung]" placeholder="Câu trả lời 2" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dap_an_dung" value="2">
                    <input type="text" class="form-control" name="cau_tra_lois[2][noi_dung]" placeholder="Câu trả lời 3" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dap_an_dung" value="3">
                    <input type="text" class="form-control" name="cau_tra_lois[3][noi_dung]" placeholder="Câu trả lời 4" required>
                </div>
                <!-- Thêm các input cho các câu trả lời khác nếu cần -->
            </div>

            <button type="submit" class="btn btn-primary">Thêm Câu Hỏi</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200, // Độ cao của trình soạn thảo
            // Cấu hình thêm nếu cần
        });
    });
</script>
@endsection
