<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yody</title>
    @include('layout.style')

</head>

<body>

<nav class="navbar navbar-expand-sm fixed-top  shadow fw-bold" style="backdrop-filter: blur(5px);">
    <div class="container">
        <div class="d-flex align-items-center">
            <!-- Logo -->
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('/')}}">
                        <img src="public/img/logo.svg" alt="">
                    </a>
                </li>
            </ul>

            <!-- Menu -->
            <ul class="navbar-nav ms-5">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu/'."1") }}">Nam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu/'."2") }}">Nữ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu/'."4") }}">Trẻ em</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu/'."3") }}">Đồng phục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Đối tác</a>
                </li>
            </ul>
        </div>


        <!-- Đăng nhập đăng ký giỏ hàng tìm kiếm-->
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item ms-3">
                <form class="d-flex align-items-center border rounded-pill shadow-sm bg-light px-3 py-2 me-2"
                      action="{{route('search')}}" method="get">
                    <input class="form-control-plaintext border-0 me-2" name="keyword" type="text" placeholder="Bạn tìm gì ..."
                           aria-label="Search" >
                    <button type="submit"  class="btn btn-warning rounded-pill px-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </li>
            <li class="nav-item ms-3">
                <a class="nav-link" href="{{route('list-cart')}}">
                    <button class="btn position-relative">
                        <i class="fa-solid fa-cart-plus"></i> <span
                                class="badge bg-warning rounded-pill position-absolute"
                                style="top:-5px; right: -8px;">
                            @php
                            if(isset($_SESSION['giohang'])){
                                echo count($_SESSION['giohang']);
                            }
                            @endphp
                        </span>
                    </button>
                </a>
            </li>
            @if(isset($_SESSION['user']))
                <li class="nav-item ms-3">
                    <a class="nav-link" href="{{route('form-login')}}"><i class="fa-regular fa-user"></i> {{$_SESSION['user']->username}}</a>
                </li>
            @else
                <li class="nav-item ms-3">
                    <a class="nav-link" href="{{route('form-login')}}"><i class="fa-regular fa-user"></i> Đăng nhập</a>
                </li>
                <div class="text-black">
                    <span class="ms-1 m-1">/</span>
                </div>
                <li class="nav-item">
                    <a class="nav-link " href="login/dangky.html">Đăng ký</a>
                </li>
            @endif
        </ul>
    </div>

</nav>

<main>
    <div class="container" style="min-height: calc(100vh - 420px);margin-top: 90px;">
    <section class="content">
        @yield('content')
    </section>
    </div>


</main>

<footer>
    <div class="container-fluid border-top text-center pt-3 pb-3 mt-4 text-white"
         style="background-color: #002655;">
        <div class="container mt-3">
            <div class="row">
                <div class="col-4 mt-5">
                    <h7>“Đặt sự hài lòng của khách hàng là ưu tiên số 1 trong mọi suy nghĩ hành động của mình” là sứ
                        mệnh,
                        là triết lý, chiến lược.. luôn cùng YODY tiến bước"
                    </h7>
                    <br>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-tiktok"></i>
                    <i class="fa-brands fa-youtube"></i>
                </div>
                <div class="col-4">
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
                <div class="col-4">
                    <h5>Công ty thời trang YODY</h5>
                    <a href="" class="nav-link"><i class="fa-solid fa-map"></i> Công ty cổ phần Thời trang YODY
                        Mã số thuế: 0801206940
                        Địa chỉ: Đường An Định - Phường Việt Hòa - Thành phố Hải Dương - Hải Dương</a>
                    <img src="public/img/logo_bct.webp" alt="">
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
