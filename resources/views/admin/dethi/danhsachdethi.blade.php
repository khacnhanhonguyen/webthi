@extends('admin.master') {{-- Thay thế bằng layout bạn đang sử dụng --}}
@section('content')
    <h1>Danh sách đề thi</h1>
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
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Banner</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Ngày bắt đầu</th>
                <th scope="col">Ngày kết thúc</th>
                <th scope="col">Hành Động</th>
                {{-- Thêm các cột khác nếu cần --}}
            </tr>
        </thead>
        <tbody>
            @foreach($listDeThi as $deThi)
            <tr>
                <td>
                    @if($deThi->anh_de_thi)
                        <img src="/images/{{$deThi->anh_de_thi}}" alt="Banner" style="max-width: 100px;">
                    @else
                        No Banner
                    @endif
                </td>
                <td>{{ $deThi->tieu_de }}</td>
                <td>{{ $deThi->ngay_bat_dau }}</td>
                <td>{{ $deThi->ngay_ket_thuc }}</td>
                <td>
                    <a href="" class="btn btn-info">Danh sách câu hỏi</a>
                    <a href="" class="btn btn-warning">Sửa</a>
                    <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteDeThi({{ $deThi->id }})">Xóa</a>
                    {{-- Thêm thuộc tính dữ liệu để lưu đường dẫn xoá --}}
                </td>
            </tr>
        @endforeach

        <script>
            function deleteDeThi(id) {
                if (confirm('Bạn có chắc chắn muốn xoá bài thi này không?')) {
                    // Tạo một form động
                    var form = document.createElement('form');
                    form.action = '/admin/dethi/' + id;
                    form.method = 'POST'; // Sử dụng phương thức POST để giả mạo DELETE
                    form.style.display = 'none';

                    // Thêm một input giả mạo phương thức (yêu cầu bởi Laravel)
                    var methodInput = document.createElement('input');
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    // Thêm input token CSRF (yêu cầu bởi Laravel)
                    var tokenInput = document.createElement('input');
                    tokenInput.name = '_token';
                    tokenInput.value = '{{ csrf_token() }}';
                    form.appendChild(tokenInput);

                    // Thêm form vào body và submit nó
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        </script>

        </tbody>
    </table>
@endsection
