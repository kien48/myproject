@extends("layout.main")
@section("content")
    <style>
        .card-body {
            padding: 20px;
        }

        .card-body p {
            margin-bottom: 20px;
        }

        .card-body .btn {
            padding: 10px 20px;
        }

        @media (max-width: 768px) {
            .card-body .btn {
                margin-bottom: 10px;
            }
        }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    @if(isset($_SESSION['user']))
                        @if(isset($_SESSION['success']) && isset($_GET['msg']))
                            <div class="alert alert-success" role="alert">
                                <span>{{$_SESSION['success']}}</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p>Xin chào <strong>{{$_SESSION['user']->username}}</strong></p>
                                </div>

                                @php
                                    $rank = "";
                                    if($_SESSION['user']->rank == 0){
                                        $rank = "Đồng";
                                    }else if($_SESSION['user']->rank == 1){
                                        $rank = "Bạc";
                                    }else if($_SESSION['user']->rank == 2){
                                        $rank = "Vàng";
                                    }else if($_SESSION['user']->rank == 3){
                                        $rank = "Kim Cương";
                                    }
                                @endphp
                                <div class="col-md-12 text-center">
                                    <p>Thành viên hạng : <strong>{{$rank}}</strong></p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <a href="{{ route("inbox") }}" class="btn btn-danger mb-2 btn-block w-100 position-relative">
                                        Hộp thư
                                        <span class="badge bg-warning rounded-pill position-absolute" style="top: -5px; right: -8px;">
            @php
                if(isset($demUser) && !empty($demUser)){
                    echo count($demUser);
                }else{
                    echo 0;
                }
            @endphp
        </span>
                                    </a>
                                </div>


                                <div class="col-md-12">
                                    <a href="{{route("list-order")}}" class="btn btn-primary mb-2 btn-block  w-100">Đơn hàng đã mua</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route("form-update")}}" class="btn btn-warning mb-2 btn-block  w-100">Cập nhật tài khoản</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route("form-update/pass")}}" class="btn btn-warning mb-2 btn-block  w-100">Thay đổi mật khẩu</a>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{route("logout")}}" class="btn btn-secondary btn-block  w-100">Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-header bg-white d-flex justify-content-center">
                            <h3 style="color: #002655;">ĐĂNG </h3>
                            <h3 style="color: #FFD700;">NHẬP</h3>
                        </div>
                        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <li>{{$_SESSION['errors']}}</li>
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form method="post" action="{{route('login')}}">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" placeholder="Nhập email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu:</label>
                                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="pass">
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <a class="btn btn-warning text-white" href="{{route('form-register')}}" style="margin-right: 10px;">Đăng ký</a>
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Đăng nhập</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
