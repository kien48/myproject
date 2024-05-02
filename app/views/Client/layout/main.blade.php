<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $_SESSION['listSettings'][0]->company_name }}</title>
    <link rel="icon" type="image/png" href="{{ $_SESSION['listSettings'][0]->logo }}">
    @include('layout.style')
</head>

<body>
    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <nav class="navbar navbar-expand-sm fixed-top shadow fw-bold" style="backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img src="{{ $_SESSION['listSettings'][0]->logo }}" alt="Logo" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-5">
                    @foreach($_SESSION['category'] as $ct)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu/'.$ct->id) }}">{{$ct->name}}</a>
                    </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post/1') }}">Bài viết</a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <form class="d-flex align-items-center border rounded-pill shadow-sm bg-light px-3 py-2 me-2" action="{{ route('search') }}" method="get">
                            <input class="form-control-plaintext border-0 me-2" name="keyword" type="text" placeholder="Bạn tìm gì ..." aria-label="Search">
                            <button type="submit" class="btn btn-warning rounded-pill px-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-cart') }}">
                            <button class="btn position-relative">
                                <i class="fa-solid fa-cart-plus"></i>
                                <span class="badge bg-warning rounded-pill position-absolute" style="top: -5px; right: -8px;">
                                    @php
                                    if(isset($_SESSION['giohang'])){
                                    echo count($_SESSION['giohang']);
                                    }else{
                                    echo 0;
                                    }
                                    @endphp
                                </span>
                            </button>
                        </a>
                    </li>
                    @if(isset($_SESSION['user']))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('form-login') }}">
                            <i class="fa-regular fa-user"></i> {{ $_SESSION['user']->username }}
                        </a>
                    </li>
                    @else
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="{{ route('form-login') }}">
                            <i class="fa-regular fa-user"></i> Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">/</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('form-register') }}">Đăng ký</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section class="content">
            @yield('content1')
        </section>
        <div class="container" style="min-height: calc(100vh - 412px); margin-top: 90px;">
            <section class="content">
                @yield('content')
            </section>
        </div>
    </main>


    <footer>
        <div class="container-fluid border-top text-center pt-3 pb-3 mt-4 text-white" style="background-color: #002655;">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-4 mt-5">
                        <h7>“{{ $_SESSION['listSettings'][0]->sayings }}”
                        </h7>
                        <br>
                        <a href="{{ $_SESSION['listSettings'][0]->link_fb }}"><i class="fa-brands fa-facebook"></i></a>
                        <a href="{{ $_SESSION['listSettings'][0]->link_tiktok }}" class="text-white ms-3"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="{{ $_SESSION['listSettings'][0]->link_yt }}" class="text-danger ms-3"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                    <div class="col-md-4">
                        <h5>Về YODY</h5>
                        <h7>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="text-white nav-link" href="#">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Liên hệ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Tuyển dụng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="#">Đăng ký đối tác</a>
                                </li>
                            </ul>
                        </h7>
                    </div>
                    <div class="col-md-4">
                        <h5><i class="fa-solid fa-building"></i> {{ $_SESSION['listSettings'][0]->company_name }}</h5>
                        <p>
                            <i class="fa-solid fa-phone-volume"></i> Số điện thoại: {{ $_SESSION['listSettings'][0]->phone }} <br>
                            Địa chỉ: {{ $_SESSION['listSettings'][0]->address }}
                        </p>
                        <img src="https://cdn.dangkywebsitevoibocongthuong.com/wp-content/uploads/2018/07/logo-da-thong-bao-website-voi-bo-cong-thuong.webp" alt="" height="40px">
                    </div>
                </div>
                <hr>
                <h7>Bản quyền thuộc về kiên</h7>
            </div>
        </div>
    </footer>
    @extends("layout.js")


</body>

</html>