@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Thêm người dùng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Thêm người dùng</li>
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
        <form method="POST" action="{{ route('admin.users.create-process') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Quyền:</label>
                <select class="form-select" name="role" required>
                    <option value="0">Thí sinh</option>
                    <option value="1">Giáo viên</option>
                    @if(auth()->user()->phanquyen == 2)
                        <option value="2">Giáo vụ </option>
                    @endif


                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tạo người dùng</button>
        </form>
    </div>
@endsection
