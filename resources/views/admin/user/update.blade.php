@extends('admin.master')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa người dùng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Sửa người dùng</li>
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
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')  <!-- Đặt phương thức HTTP là PUT để cập nhật -->

            <div class="mb-3">
                <label for="name" class="form-label">Tên:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select class="form-select" name="role" required>
                    <option value="0" {{ $user->phanquyen == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->phanquyen == 1 ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật User</button>
        </form>
    </div>
@endsection
