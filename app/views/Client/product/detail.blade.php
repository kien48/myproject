<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yody</title>
    @include('layout.style')
</head>

<body>
<div class="loading-overlay">
    <div class="loading-spinner"></div>
</div>
<nav class="navbar navbar-expand-sm fixed-top  shadow fw-bold" style="backdrop-filter: blur(5px);">
    <div class="container">
        <div class="d-flex align-items-center">
            <!-- Logo -->
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('/')}}">
                        <img src="../public/img/logo.svg" alt="">
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
    <div class="row">
        <div class="d-flex justify-content-between mb-3">
            <h1 class="h5 text-black-50">{{$product->category_name}} / {{$product->name}}</h1>
        </div>
        <div class="col-md-4">
            <div class="bg-light d-flex align-items-center" style="height: 560px;">
                <img src="../{{$product->image}}" alt="" class="mh-100 mw-100">
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-light d-flex align-items-center" style="height: 560px;">
                <img src="../{{$product->image2}}" alt="" class="mh-100 mw-100">
            </div>
        </div>

        <div class="table-responsive col-md-4">
            <div class="">
                <h1 class="h3">{{$product->name}}</h1>
                <div class="d-flex align-items-center">
                    <h1 class="h5">Đã bán 125 | @if($rating->average_rating !=0)
                            <span class="badge bg-warning"> {{number_format($rating->average_rating)}} sao </span>
                            <h5 class="ms-1"> | {{$rating->number}} lượt đánh giá </h5>
                        @else
                            <span>Chưa có đánh giá sản phẩm</span>

                        @endif

                    </h1>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Giá bán -->
                    <div class="fw-bold text-danger h3">{{number_format($product->price)}}đ</div>
                    <!-- Giá niêm yết -->
                    <div class="text-decoration-line-through ms-2">219.000đ</div>

                </div>

                <div>
                    <h1 class="h4">Màu sắc:</h1>
                    <div class="d-flex">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="color_radio1" name="color_radio"
                                   value="color_option1" checked>Xanh
                            <label class="form-check-label" for="color_radio1"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="color_radio2" name="color_radio"
                                   value="color_option2">Đỏ
                            <label class="form-check-label" for="color_radio2"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="color_radio2" name="color_radio"
                                   value="color_option2">Tím
                            <label class="form-check-label" for="color_radio2"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="color_radio2" name="color_radio"
                                   value="color_option2">Vàng
                            <label class="form-check-label" for="color_radio2"></label>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="h4">Kích cỡ:</h1>
                    <div class="d-flex">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="size_radio1" name="size_radio"
                                   value="size_option1" checked>M
                            <label class="form-check-label" for="size_radio1"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="size_radio2" name="size_radio"
                                   value="size_option2">L
                            <label class="form-check-label" for="size_radio2"></label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="size_radio3" name="size_radio"
                                   value="size_option3">XL
                            <label class="form-check-label" for="size_radio3"></label>
                        </div>
                    </div>
                </div>

                <div>
                    <form action="{{route('add-cart')}}" method="post">
                    <h1 class="h4">Số lượng:</h1>
                    <div class="d-flex">
                        <div class="input-group">
                            <button onclick="minus(this)" type="button" class="btn btn-outline-secondary btn-sm">-</button>
                            <input onkeyup="kiemtrasoluong(this)" value="{{$soLuong}}" type="text" class="form-control form-control-sm" name="quantity" min="1" max="50" style="max-width: 35px">
                            <button onclick="plus(this)" type="button" class="btn btn-outline-secondary btn-sm">+</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="name" value="{{$product->name}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <input type="hidden" name="image" value="{{$product->image}}">
                        <input type="hidden" name="category" value="{{$product->category_name}}">
                        <button name="them" onclick="return alert('thêm vào giỏ thành công')" class="btn btn-warning w-100 col-12 mt-3"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                            hàng</button>
                    <button type="button" class="btn btn-outline-light text-dark w-100 border-dark col-12 mt-3">Mua ngay</button>

                    </form>


                </div>

            </div>
        </div>

        <div class="col-md-8">
            <hr>
            <h1 class="h3">Đặc tính nổi bật</h1>
            <h1 class="h5 ">
               {{$product->description}}
            </h1>
            <div id="accordion">

                <div class="card mt-2">
                    <div class="card-header">
                        <a class="collapsed btn w-100" data-bs-toggle="collapse" href="#collapseTwo">
                            Hướng dẫn sử dụng
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <h1 class="h5">
                                <ul>
                                    <li>Giặt máy chế độ nhẹ với sản phẩm cùng màu ở nhiệt độ thường.</li>
                                    <li>Không giặt chung với các vật sắc nhọn.</li>
                                    <li>Không sử dụng chất tẩy rửa.</li>
                                    <li>Sử dụng xà phòng trung tính</li>
                                    <li>Lộn trái và phơi bằng móc trong bóng râm, tránh ánh nắng trực tiếp</li>
                                    <li>Là ủi ở mức 1, Nhiệt độ dưới 110 độ C</li>
                                </ul>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <a class="collapsed btn w-100" data-bs-toggle="collapse" href="#collapseThree">
                            Đánh giá
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <form class=" mb-3" method="post" action="{{route('add-comment/'.$product->id)}}">
                                <textarea name="content" id="" cols="30" rows="5" class="form-control me-2" placeholder="Nhập bình luận @if(isset($_SESSION['user']))đi nào {{$_SESSION['user']->username}} @else với tư cách người ẩn danh
                                @endif
                                "></textarea>
                                @if(isset($_SESSION['user']))
                                    <div class="ms-auto">
                                        <div class="rating-star d-flex justify-content-center">
                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option1" value="5">
                                                <label for="option1">5 sao</label>
                                            </div>
                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option2" value="4">
                                                <label for="option2">4 sao</label>
                                            </div>

                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option3" value="3">
                                                <label for="option3">3 sao</label>
                                            </div>

                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option4" value="2">
                                                <label for="option4">2 sao</label>
                                            </div>

                                            <div class="ms-4">
                                                <input type="radio" name="option[]" id="option5" value="1">
                                                <label for="option5">1 sao</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-primary" type="submit" name="send">Gửi</button>
                            </form>
                            @foreach($listComment as $list)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title">@if ($list->username)
                                                    {{$list->username}}
                                                @else
                                                   Người ẩn danh
                                                @endif
                                            </h5>
                                            <h4 class="text-warning">@if ($list->star != 0)
                                                    {{$list->star}} sao
                                                @endif </h4>
                                        </div>
                                        <p class="card-text">{{$list->content}}</p>
                                    </div>

                                </div>
                            @endforeach

                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="row">
        <div class="d-flex justify-content-between mt-4">
            <h1 class="h4 text-black-50">Sản phẩm liên quan</h1>
        </div>
        @foreach($productCL as $pro)
            <div class="col-md-3">
                <!-- box hiển thị sản phẩm -->
                <a href="{{route('detail/'.$pro->id)}}" class="nav-link">
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <!-- Khu vực ảnh -->
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 406px;">
                            <img src="../{{$pro->image}}" alt="" class="mh-100 mw-100">
                        </div>
                        <div class="m-2">
                            <!-- Kv tên sản phẩm -->
                            <h1 class="h5" style="height: 68px; ">{{$pro->name}}</h1>
                </a>
                            <div class="d-flex justify-content-center">
                                <!-- Giá bán -->
                                <div class="fw-bolder text-danger">{{number_format($pro->price)}} vnđ</div>
                            </div>
                <form action="{{route('add-cart')}}" method="post">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="name" value="{{$product->name}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <input type="hidden" name="image" value="{{$product->image}}">
                    <input type="hidden" name="category" value="{{$product->category_name}}">
                    <button name="them" onclick="return alert('thêm vào giỏ thành công')" class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i
                                class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                </form>
                            <!-- KV button tương tác -->

                        </div>
                    </div>

            </div>
        @endforeach

    </div>

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
                    <img src="../public/img/logo_bct.webp" alt="">
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