@extends('client.master')
@section('content')
<h2>Danh sách đề thi</h2>
<ul>
    @foreach ($deThiList as $deThi)
    <div class="row-item row">
        <div class="col-md-3">

            <a href="detail.html">
                <br>
            <img width="100%" height="200px" class="img-responsive" src="images/{{$deThi->anh_de_thi}}" alt="">
            </a>
        </div>

        <div class="col-md-9">
            <h1 class="mt-4"><b>{{$deThi->tieu_de}}</b></h1>
            @if ($deThi->mo_thi==1)
            <a class="btn btn-primary" href="{{ auth()->check() ? route('route.thithuc.hien', ['de_thi_id'=>$deThi->id]) : route('route.login') }}">Thi chính thức<span class="glyphicon glyphicon-chevron-right"></span></a>
            @endif
            <a class="btn btn-success" href="{{ route('route.thithu.hien', ['de_thi_id'=>$deThi->id]) }}">Thi thử<span class="glyphicon glyphicon-chevron-right"></span></a>
            <a class="btn btn-info" href="{{ route('route.xemcuocthi.hien', ['de_thi_id'=>$deThi->id]) }}">Xem thông tin cuộc thi<span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
        <div class="break"></div>

    </div>
    <br><br>
    @endforeach
</ul>
@endsection
