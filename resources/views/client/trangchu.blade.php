@extends('client.master')
@section('content')
    <div class="top-news">
        <div class="container">
            <!-- slider -->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $i = 0; ?>
                    @foreach ($dethis as $slide)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"
                            @if ($i==0)
                                class="active"
                            @endif
                        ></li>
                        <?php $i++; ?>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    <?php $i = 0; ?>
                    @foreach ($dethis as $slide)
                        <div
                        @if ($i==0)
                            class="carousel-item active"
                        @else
                            class="carousel-item"
                        @endif>
                            <a href="https://{{$slide->link}}">
                                <img class="d-block w-100" src="images/{{$slide->anh_de_thi}}" height="500px" alt="{{$slide->tieu_de}}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{$slide->tieu_de}}</h5>
                                </div>
                            </a>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- end slide -->
        </div>
    </div>
    <div>
        <div class="thele columnhome">
        <div class="header-tit"><a href="#">Thể lệ cuộc thi</a></div>
        <div class="title-li box1" style="height: 270px !important">
            <div class="content-home" style="height: 250px; overflow: hidden;">
                <span>
                I. ĐỐI TƯỢNG DỰ THI
                    Người Việt Nam ở trong nước; người Việt Nam ở nước ngoài và người nước ngoài đang sinh sống, học tập và làm việc trên lãnh thổ Việt Nam.

                    II. NỘI DUNG THI
                    1. Luật Phòng, chống tác hại của rượu, bia năm 2019 và các văn bản hướng dẫn thi hành có liên quan;
                    2.  Nghị định số 82/2020/NĐ-CP ngày 15/7/2020 của Chính phủ quy định xử phạt vi phạm hành chính trong lĩnh vực bổ trợ tư pháp; hành chính tư pháp; hôn nhân và gia đình; thi hành án dân sự; phá sản doanh nghiệp, hợp tác xã.
                </span>
            </div>
        </div>
        </div>
        <div class="tintuc columnhome">
        <div class="header-tit"><a href="">Thông tin về cuộc thi</a></div>
        <div class="title-li box2" style="height:270px!important">
            <ul>

                <li><a href="">Kết quả Cuộc thi trực tuyến tìm hiểu pháp luật “Pháp luật với mọi người” mang đến nhiều cái “nhất”, lan toả sâu rộng phong trào tìm hiểu, học tập pháp luật trong các tầng lớp Nhân dân</a></li>

                <li><a href="">Cuộc thi trực tuyến "Pháp luật với mọi người": KẾT THÚC VỚI HƠN 856.000 LƯỢT DỰ THI</a></li>

                <li><a href="">Cuộc thi trực tuyến "Pháp luật với mọi người": ĐÃ CÓ HƠN 600.000 LƯỢT THI</a></li>

                <li><a href="">Cuộc thi trực tuyến "Pháp luật với mọi người": VƯỢT MỐC 450.000 LƯỢT THI</a></li>

                <li><a href="">Cuộc thi trực tuyến "Pháp luật với mọi người": ĐÃ CÓ HƠN 300.000 LƯỢT THI</a></li>

            </ul>
        </div>
        </div>
    </div>
@endsection
