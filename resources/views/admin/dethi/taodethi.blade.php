@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm Đề Thi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Thêm Đề Thi</li>
        </ol>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.dethi.create-process') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="tieu_de" class="form-label">Tiêu đề:</label>
                <input type="text" class="form-control" name="tieu_de" required>
            </div>

            <div class="mb-3">
                <label for="anh_de_thi" class="form-label">Banner:</label>
                <input type="file" class="form-control" name="anh_de_thi">
            </div>

            <div class="mb-3">
                <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu:</label>
                <input type="date" class="form-control" name="ngay_bat_dau" required>
            </div>

            <div class="mb-3">
                <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc:</label>
                <input type="date" class="form-control" name="ngay_ket_thuc" required>
            </div>

            <div class="mb-3">
                <label for="thoi_gian_lam_bai" class="form-label">Thời gian làm bài:</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="gio" required>
                    <span class="input-group-text">giờ</span>
                </div>
                <div class="input-group mt-2">
                    <input type="number" class="form-control" name="phut" required>
                    <span class="input-group-text">phút</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="mo_ta_cuoc_thi" class="form-label">Mô tả cuộc thi:</label>
                <textarea class="form-control" name="mo_ta_cuoc_thi" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Tạo Đề Thi</button>
        </form>
    </div>
@endsection
