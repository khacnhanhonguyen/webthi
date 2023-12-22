<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/trangchu/trangchu.css">
  <title>Your Page Title</title>
</head>
<body>

  <div id="menu">
    <div class="menu-top">
      <div class="left">
        <ul>
          <li><a href="#"><img style="width: 25px;" src="trangchu/home.png"></a></li>
          <li><a href="#">Trang chủ</a></li>
          <li><a href="#">Giới thiệu</a></li>
          <li><a href="#">Thông tin cuộc thi</a></li>
          <li><a href="#">Tham gia</a></li>
          <li><a href="">Kết quả cuộc thi</a></li>
        </ul>
      </div>
      <div class="right">
        <div class="login">
            @if (Auth::check())

                <a class=" dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle"
                    src="/trangchu/avatar.png" width="30px" height="30px">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#profile">
                    <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
            @else
                <a class="quantri" href="{{ route('route.login') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;Đăng nhập

                </a>
            @endif
        </div>
      </div>
    </div>
  </div>
  @yield('content')
  <div id="footer">
    <div id="google-analytics"></div>
        <div class="footer-c">
            <div class="footer-content">
                <p class="title">CỔNG THÔNG TIN ĐIỆN TỬ BỘ TƯ PHÁP</p>
                <div class="info">
                    <p>
                        <strong>Địa chỉ:</strong> 60 Trần Phú, Ba Đình, Hà Nội. <strong>024.62739718 - 024.62739359.</strong>
                        <strong>Email:</strong> banbientap@moj.gov.vn; cntt@moj.gov.vn.
                    </p>
                    <p>Giấy phép cung cấp thông tin trên internet số 28/GP-BC ngày 25/03/2005.</p>
                    <p>Trưởng Ban biên tập: Nguyễn Tiến Dũng - Cục trưởng Cục Công nghệ thông tin.</p>
                    <p>Ghi rõ nguồn Cổng thông tin điện tử Bộ Tư pháp (www.moj.gov.vn) khi trích dẫn lại tin từ địa chỉ này.</p>
                </div>
            </div>
        </div>
    </div>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Lựa chọn Logout bên dưới nếu bạn đã sẵn sàng thoát</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('route.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/trangchu/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/trangchu/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
