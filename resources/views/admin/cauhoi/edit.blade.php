<!-- resources/views/admin/cauhoi/edit.blade.php -->

@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa câu hỏi</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Sửa câu hỏi
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.cauhoi.update', ['id' => $cauHoi->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="noi_dung" class="form-label">Nội dung câu hỏi:</label>
                        <input type="text" class="form-control" name="noi_dung" value="{{ $cauHoi->noi_dung }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="cau_tra_lois" class="form-label">Đáp án:</label>
                        @foreach($cauHoi->cauTraLois as $cauTraLoi)
                            <div class="input-group mb-3">
                                <input type="hidden" name="cau_tra_lois[{{ $cauTraLoi->id }}][id]" value="{{ $cauTraLoi->id }}">
                                <input type="text" class="form-control" name="cau_tra_lois[{{ $cauTraLoi->id }}][noi_dung]" value="{{ $cauTraLoi->noi_dung }}" required>
                                <div class="input-group-text">
                                    <input type="radio" name="dap_an" value="{{ $cauTraLoi->id }}" {{ $cauTraLoi->dung_sai ? 'checked' : '' }}> Đúng
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật câu hỏi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
