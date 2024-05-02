@extends("layout.main")
@section("content1")
<!-- Banner -->
<div>
    <div id="demo" class="carousel slide overflow-hidden" data-bs-ride="carousel" style="max-height: 730px; overflow: hidden;">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
        </div>

        <!-- The slideshow/carousel -->

        <div class="carousel-inner">
            <div class="carousel-item active">
                <video autoplay loop muted>
                    <source src="public/img/video1.mp4" type="video/mp4">
                </video>

            </div>
            <div class="carousel-item">
                <div style="height: 76px" class="bg-white"></div>
                <a href="{{ route('post/detail/'.$_SESSION['listSettings'][0]->link_bn_1) }}">
                    <img src="{{ $_SESSION['listSettings'][0]->banner1 }}" class="w-100" height="656px" alt="Banner 1">
                </a>
            </div>
            <div class="carousel-item">
                <div style="height: 76px;" class="bg-white"></div>
                <a href="{{ route('post/detail/'.$_SESSION['listSettings'][0]->link_bn_2) }}">
                    <img src="{{ $_SESSION['listSettings'][0]->banner2 }}" class="w-100 " height="656px" alt="Banner 2">
                </a>
            </div>
            <div class="carousel-item">
                <div style="height: 76px;" class="bg-white"></div>
                <a href="{{ route('post/detail/'.$_SESSION['listSettings'][0]->link_bn_3) }}">
                    <img src="{{ $_SESSION['listSettings'][0]->banner3 }}" class="w-100" height="656px" alt="Banner 3">
                </a>
            </div>
        </div>


        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>
@endsection
@section("content")

<!-- Sản phẩm mới nhất -->
<div class="container mt-2">
    <div class="d-flex justify-content-center">
        <h1 class="h2 text-warning">Sản phẩm mới nhất</h1>
    </div>
    <div class="row">
        @foreach($new as $n)
        <div class="col-md-3 col-lg-3">
            <div class="border mt-3 mb-3 rounded overflow-hidden  bg-light">
                <a class="nav-link" href="{{route('detail/'.$n->id)}}">
                    <div class="d-flex align-items-center justify-content-center" style="height: 398px;">
                        <div class="image-container">
                            <img src="{{$n->image}}" alt="" class="mh-100 mw-100">
                        </div>
                    </div>
                    <div class="m-2">
                        <h1 class="h5" style="height: 68px;">{{$n->name}}</h1>
                </a>
                <div class="d-flex justify-content-center">
                    <div class="fw-bolder text-danger">{{number_format($n->price)}} vnđ</div>
                </div>
            </div>
            <div class="container text-center mt-2">
                <div class="row">

                    @php
                    $usedColors = []; // Mảng lưu trữ các màu đã được sử dụng
                    @endphp

                    @foreach($bienThe as $item)
                    @if($item->idpro == $n->id)
                    @php
                    $color = $item->color;

                    // Kiểm tra xem màu đã được sử dụng trước đó chưa
                    if (!in_array($color, $usedColors)) {
                    switch ($color) {
                    case "Hồng":
                    $style = "pink";
                    break;
                    case "Đen":
                    $style = "black";
                    break;
                    case "Đỏ":
                    $style = "red";
                    break;
                    case "Trắng":
                    $style = "white";
                    break;
                    case "Vàng":
                    $style = "yellow";
                    break;
                    case "Xanh":
                    $style = "green";
                    break;
                    default:
                    // Màu không được quy định, hoặc xử lý mặc định nếu cần
                    $style = "default_style";
                    break;
                    }

                    $usedColors[] = $color; // Đánh dấu màu đã được sử dụng
                    } else {
                    $style = ''; // Nếu màu đã được sử dụng, không cần áp dụng màu mới
                    }
                    @endphp

                    @if($style != '')
                    <div class="col-2">
                        <div class="h3" style="color: {{$style}} " data-bs-toggle="tooltip" title="{{$item->color}}"><i class="fa-solid fa-circle rounded-pill border shadow"></i></div>
                    </div>
                    @endif
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
<!-- Sản phẩm bán chạy -->
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h1 class="h4 text-black-50">Sản phẩm bán chạy</h1>
        <a href="{{route('top')}}" class="nav-link">
            <h1 class="h4 text-black-50"><i class="fa-solid fa-chevron-left"></i> Xem thêm</h1>
        </a>
    </div>
    <div class="row">
        @foreach($bestSeller as $best)
        <div class="col-md-3 ">
            <div class="border mt-3 mb-3 rounded overflow-hidden bg-light">
                <a href="{{route('detail/'.$best->id_product)}}" class="nav-link">
                    <div class="d-flex align-items-center justify-content-center" style="height: 398px;">
                        <div class="image-container">
                            <img src="{{$best->image}}" alt="" class="mh-100 mw-100">
                        </div>
                    </div>
                    <div class="m-2">
                        <h1 class="h5" style="height: 68px;">{{$best->product_name}}</h1>
                </a>
                <div class="d-flex justify-content-center">
                    <div class="fw-bolder text-danger">{{number_format($best->price)}} vnđ</div>
                </div>
            </div>
            <div class="container text-center mt-2">
                <div class="row">
                    @php
                    $usedColors = []; // Mảng lưu trữ các màu đã được sử dụng
                    @endphp

                    @foreach($bienThe as $item)
                    @if($item->idpro == $best->id_product)
                    @php
                    $color = $item->color;

                    // Kiểm tra xem màu đã được sử dụng trước đó chưa
                    if (!in_array($color, $usedColors)) {
                    switch ($color) {
                    case "Hồng":
                    $style = "pink";
                    break;
                    case "Đen":
                    $style = "black";
                    break;
                    case "Đỏ":
                    $style = "red";
                    break;
                    case "Trắng":
                    $style = "white";
                    break;
                    case "Vàng":
                    $style = "yellow";
                    break;
                    case "Xanh":
                    $style = "green";
                    break;
                    default:
                    // Màu không được quy định, hoặc xử lý mặc định nếu cần
                    $style = "default_style";
                    break;
                    }

                    $usedColors[] = $color; // Đánh dấu màu đã được sử dụng
                    } else {
                    $style = ''; // Nếu màu đã được sử dụng, không cần áp dụng màu mới
                    }
                    @endphp

                    @if($style != '')
                    <div class="col-2">
                        <div class="h3" style="color: {{$style}}" data-bs-toggle="tooltip" title="{{$item->color}}"><i class="fa-solid fa-circle  rounded-pill border shadow"></i></div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

<!-- Banner -->
<div class="bg-warning d-flex align-items-center justify-content-center" style="height: 406px;">
    <img src="{{$_SESSION['listSettings'][0]->banner}}" alt="" class="mh-100 mw-100">
</div>

<!-- Sản phẩm trẻ em -->
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h1 class="h4 text-black-50">Sản phẩm trẻ em</h1>
        <a href="{{ route('menu/'."4") }}" class="nav-link">
            <h1 class="h4 text-black-50"><i class="fa-solid fa-chevron-left"></i> Xem thêm</h1>
        </a>
    </div>
    <div class="row">
        @foreach($kids as $kid)
        <div class="col-md-3">
            <div class="border mt-3 mb-3 rounded overflow-hidden  bg-light">
                <a href="{{route('detail/'.$kid->id)}}" class="nav-link">
                    <div class="d-flex align-items-center justify-content-center" style="height: 398px;">
                        <div class="image-container">
                            <img src="{{$kid->image}}" alt="" class="mh-100 mw-100">
                        </div>
                    </div>
                    <div class="m-2">
                        <h1 class="h5" style="height: 68px;">{{$kid->name}}</h1>
                </a>
                <div class="d-flex justify-content-center">
                    <div class="fw-bolder text-danger">{{number_format($kid->price)}} vnđ</div>
                </div>
            </div>

            <div class="container text-center mt-2">
                <div class="row">
                    @php
                    $usedColors = []; // Mảng lưu trữ các màu đã được sử dụng
                    @endphp

                    @foreach($bienThe as $item)
                    @if($item->idpro == $kid->id)
                    @php
                    $color = $item->color;

                    // Kiểm tra xem màu đã được sử dụng trước đó chưa
                    if (!in_array($color, $usedColors)) {
                    switch ($color) {
                    case "Hồng":
                    $style = "pink";
                    break;
                    case "Đen":
                    $style = "black";
                    break;
                    case "Đỏ":
                    $style = "red";
                    break;
                    case "Trắng":
                    $style = "white";
                    break;
                    case "Vàng":
                    $style = "yellow";
                    break;
                    case "Xanh":
                    $style = "green";
                    break;
                    default:
                    // Màu không được quy định, hoặc xử lý mặc định nếu cần
                    $style = "default_style";
                    break;
                    }

                    $usedColors[] = $color; // Đánh dấu màu đã được sử dụng
                    } else {
                    $style = ''; // Nếu màu đã được sử dụng, không cần áp dụng màu mới
                    }
                    @endphp

                    @if($style != '')
                    <div class="col-2">
                        <div class="h3" style="color: {{$style}}" data-bs-toggle="tooltip" title="{{$item->color}}"><i class="fa-solid fa-circle  rounded-pill border shadow"></i></div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>


@endsection