@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Danh sách user</li>
        </ol>
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

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->phanquyen == 2)
                                    Giáo vụ
                                @elseif($user->phanquyen == 1)
                                    Giảng viên
                                @elseif($user->phanquyen == 0)
                                    Thí sinh
                                @else
                                    Không xác định
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-warning">Sửa</a>
                                <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-danger"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) window.location.href = '{{ route('admin.user.delete', $user->id) }}';">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
