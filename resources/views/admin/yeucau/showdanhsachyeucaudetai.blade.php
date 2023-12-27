@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách yêu cầu đề tài</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-list me-1"></i>
                Danh sách yêu cầu đề tài
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên đề tài</th>
                                <th>Người nộp</th>
                                <th>Người duyệt</th>
                                <th>Trạng thái duyệt</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yeuCauList as $yeuCau)
                                <tr>
                                    <td>{{ $yeuCau->id }}</td>
                                    <td>{{ $yeuCau->ten }}</td>
                                    <td>{{ $yeuCau->nguoiNop->name }}</td>
                                    <td>{{ $yeuCau->nguoiDuyet ? $yeuCau->nguoiDuyet->name : 'Chưa duyệt' }}</td>
                                    <td>{{ $yeuCau->trang_thai_duyet }}</td>
                                    <td>
                                        <a href="{{ route('admin.yeucau.duyet', ['id' => $yeuCau->id]) }}" class="btn btn-success">Duyệt</a>
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
