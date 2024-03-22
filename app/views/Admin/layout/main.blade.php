<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include("layout.style")
</head>

<body>
<header >
    <nav class="navbar navbar-expand-sm bg-light " >
        <div class="container-fluid bg-light ">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="../public/img/logo.svg" alt="" height="60px">
                </li>
            </ul>
            <!-- Links -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="#">Xin chào Kiên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket" data-bs-toggle="tooltip" title="Đăng xuất"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="d-flex sticky-top" >
    <div style="width: 200px;height: calc(100vh - 80px);" class="bg-light nav-left">
        <ul class="nav flex-column">
            <li class="nav-item ni active mt-2">
                <a class="nav-link" href="{{route('admin/')}}"><i class="fa-solid fa-house"></i>  Trang chủ</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="danhmuc/list.html"> <i class="fa-solid fa-layer-group"></i>  Danh mục</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="{{ route('admin/list-product') }}"><i class="fa-solid fa-shirt"></i>  Sản phẩm</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="donhang/list.html"><i class="fa-solid fa-file-invoice-dollar"></i> Đơn hàng</a>
            </li>
        </ul>
    </div>
    <div style="width: calc(100% - 200px);">
        <section class="content">
            @yield("content")
        </section>

    </div>

</main>
@extends("layout.js")
</body>

</html>
