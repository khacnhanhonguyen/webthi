@extends('client.master')
@section('content')
<style>
.result-container {
            text-align: center;
            padding: 20px;
            background-color: rgba(17, 230, 28, 0.1);
            box-shadow: 0 4px 8px rgba(43, 163, 49, 0.1);
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #343a40;
        }

        p {
            color: #6c757d;
        }

        .button-container {
            margin-top: 20px;
        }

</style>
    <div class="result-container">
        <h1>Kết Quả Thi</h1>
        <p>Điểm số của bạn: {{ $diem }}</p>
        <p>Số câu đúng: {{$socaudung}}/{{$totalQuestions}}</p>
        <p id="thoi_gian_lam_bai"></p>
        <div class="button-container">
            <a href="{{ route('route.thamgia') }}" class="btn btn-secondary">Trở về trang tham gia</a>
        </div>
    </div>
    <script>
        // Số giây từ Laravel được truyền vào thông qua PHP
        var thoi_gian_lam_bai_seconds = {{ $thoi_gian_lam_bai }};

        // Chuyển đổi số giây thành giờ, phút, giây
        var hours = Math.floor(thoi_gian_lam_bai_seconds / 3600);
        var minutes = Math.floor((thoi_gian_lam_bai_seconds % 3600) / 60);
        var seconds = thoi_gian_lam_bai_seconds % 60;

        // Hiển thị thời gian trong phần tử có id là 'thoi_gian_lam_bai'
        document.getElementById('thoi_gian_lam_bai').innerHTML = 'Thời gian làm bài: ' + hours + ' giờ ' + minutes + ' phút ' + seconds + ' giây';
    </script>
@endsection

