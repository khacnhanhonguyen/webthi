@extends('client.master')

@section('content')
<script>
    // JavaScript function to format time from seconds to "mm:ss" format
    function formatTime(seconds) {
        var minutes = Math.floor(seconds / 60);
        var remainingSeconds = seconds % 60;

        return (minutes < 10 ? "0" : "") + minutes + ":" + (remainingSeconds < 10 ? "0" : "") + remainingSeconds;
    }
        // JavaScript function to display a dynamic message
</script>


<div class="container mt-4">
    <h2 class="alert-heading">Thông tin cuộc thi</h2>

    @if (isset($message))
        <div class="alert alert-success" role="alert">
            <p>{{ $message }}</p>
            {{-- Hiển thị thông báo khác nếu cần --}}
            <hr>
            <p class="mb-0">Cảm ơn bạn đã tham gia cuộc thi!</p>
        </div>
    @endif
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>{{ $deThi->tieu_de }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Thời gian thi:</strong> <span id="formattedTime"></span></p>
                <p><strong>Ngày bắt đầu:</strong> {{ $deThi->ngay_bat_dau }}</p>
                <p><strong>Ngày kết thúc:</strong> {{ $deThi->ngay_ket_thuc }}</p>
            </div>
            <div class="card-body">
                <h3>Danh sách người tham gia cuộc thi</h3>
                @if ($participants->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên Người Dùng</th>
                                <th scope="col">Điểm</th>
                                <th scope="col">Thời Gian Làm Bài</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $index => $participant)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $participant->user->name }}</td>
                                    <td>{{ $participant->diem }}</td>
                                    <td>{{ $participant->thoi_gian_thi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Chưa có người tham gia cuộc thi này.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Update the formatted time using JavaScript
    document.getElementById('formattedTime').innerText = formatTime({{ $deThi->thoi_gian_lam_bai }});
</script>

@endsection
