<!-- resources/views/admin/dethi/edit.blade.php -->

@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa Đề Thi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Sửa Đề Thi</li>
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
        <form method="POST" action="{{ route('admin.dethi.update', ['id' => $deThi->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tieu_de" class="form-label">Tiêu đề:</label>
                <input type="text" class="form-control" name="tieu_de" value="{{ $deThi->tieu_de }}" required>
            </div>

            <div class="mb-3">
                <label for="anh_de_thi" class="form-label">Banner:</label>
                <input type="file" class="form-control" name="anh_de_thi">
                @if ($deThi->anh_de_thi)
                    <img src="/images/{{ $deThi->anh_de_thi }}" alt="Banner" style="max-width: 100px;">
                @else
                    <p>No Banner</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu:</label>
                <input type="date" class="form-control" name="ngay_bat_dau" value="{{ $deThi->ngay_bat_dau }}" required>
            </div>

            <div class="mb-3">
                <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc:</label>
                <input type="date" class="form-control" name="ngay_ket_thuc" value="{{ $deThi->ngay_ket_thuc }}" required>
            </div>

            <div class="mb-3">
                <label for="thoi_gian_lam_bai" class="form-label">Thời gian làm bài:</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="gio" value="{{ floor($deThi->thoi_gian_lam_bai / 3600) }}" required>
                    <span class="input-group-text">giờ</span>
                </div>
                <div class="input-group mt-2">
                    <input type="number" class="form-control" name="phut" value="{{ floor($deThi->thoi_gian_lam_bai % 3600)/60 }}" required>
                    <span class="input-group-text">phút</span>
                </div>
            </div>
            <div class="mb-3">
                <input type="checkbox" name="mo_thi" {{ $deThi->mo_thi ? 'checked' : '' }}>
                <label for="mo_thi" class="form-check-label">Mở thi</label>
            </div>
            <div class="mb-3">
                <label for="mo_ta_cuoc_thi" class="form-label">Mô tả cuộc thi:</label>
                <textarea class="form-control" name="mo_ta_cuoc_thi" rows="5">{{ $deThi->mo_ta_cuoc_thi }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật Đề Thi</button>
        </form>
    </div>
@endsection
