@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách câu hỏi</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-list me-1"></i>
                    Danh sách câu hỏi
                </span>
                <a href="{{ route('admin.cauhoi.create', ['de_thi_id' => $de_thi_id]) }}" class="btn btn-success">Thêm câu hỏi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nội dung câu hỏi</th>
                                <th>Đáp án</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cauHoiList as $cauHoi)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $cauHoi->noi_dung }}</td>
                                    <td>
                                        @foreach ($cauHoi->cauTraLois as $cauTraLoi)
                                            @if ($cauTraLoi->dung_sai)
                                                - <strong style="color: red">{{ $cauTraLoi->noi_dung }}</strong> <br>
                                            @else
                                                - {{ $cauTraLoi->noi_dung }} <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.cauhoi.edit', ['id' => $cauHoi->id]) }}" class="btn btn-warning">Sửa</a>
                                        <a href="{{ route('admin.cauhoi.delete', ['id' => $cauHoi->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá câu hỏi này?')">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
