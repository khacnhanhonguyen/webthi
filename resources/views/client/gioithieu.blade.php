@extends('client.master')
@section('content')
<style>
    h1, h2 {
        color: #34bb61;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
    }

    strong {
        color: #007bff;
    }

    .featured-image {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
</style>
    <div class="container">
        <h1>{{$deThi->tieu_de}}</h1>
        <p>Thân chào các bạn Đoàn viên!</p>

        <p>Cuộc thi Tìm hiểu Nghị quyết Đại hội Đại biểu Toàn quốc Đoàn TNCS Hồ Chí Minh lần thứ XII, nhiệm kỳ 2022 – 2027 như sau:</p>
        <img class="featured-image" src="/images/{{$deThi->anh_de_thi}}" alt="Ảnh đề thi">
        <h2>Thông tin cuộc thi:</h2>
        <ul>
            <li><strong>Đối tượng:</strong> Tất cả các bạn sinh viên là cán bộ Đoàn, đoàn viên đang sinh hoạt tại Trường Đại học.</li>
            <li><strong>Thời gian thực hiện:</strong></li>
            <ul>
                <li>Tuần 1: Từ ngày 19/10 đến hết ngày 25/10/2023.</li>
                <li>Tuần 2: Từ ngày 26/10 đến hết ngày 31/10/2023.</li>
            </ul>
            <li><strong>Cách thức tham gia:</strong></li>
            <ul>
                <li>Đoàn viên truy cập trang Web ….., đăng ký tài khoản, chọn mục tham gia ->Chọn Kiểm tra học tập Nghị quyết Đại hội Đoàn toàn quốc lần thứ XII -> Chọn Thi chính thức.</li>
                <li>Đoàn viên hoàn thành 40 câu hỏi trắc nghiệm trong 45 phút, xong khi thi xong sẻ có kết quả.</li>
            </ul>
        </ul>
    </div>
@endsection
