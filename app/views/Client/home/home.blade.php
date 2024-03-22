@extends("layout.main")
@section("content")
    <!-- banner -->
    <div id="demo" class="carousel slide overflow-hidden" data-bs-ride="carousel" style="height: 400px;">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/img/YODY-web-1.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="public/img/1920x600-1-0ef01878-cc15-4665-b233-54ae41a5f1a0.webp"
                     class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="public/img/banner-new-bst-mobile.webp" class="d-block w-100">
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
    <div class="row">
        <div class="d-flex justify-content-between mt-4">
            <h1 class="h4 text-black-50">Sản phẩm mới nhất</h1>
            <a href="" class="nav-link">
                <h1 class="h4 text-black-50 "><i class="fa-solid fa-chevron-left"></i> Xem thêm</h1>
            </a>
        </div>
        @foreach($new as $n)
            <div class="col-md-3 col-lg-3">
                <!-- box hiển thị sản phẩm -->

                <div class="border mt-3 mb-3 rounded overflow-hidden">
                    <!-- Khu vực ảnh -->
                    <a class="nav-link" href="{{route('detail/'.$n->id)}}">
                        <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                            <img src="{{$n->image}}" alt="" class="mh-100 mw-100">
                        </div>
                        <div class="m-2">
                            <!-- Kv tên sản phẩm -->
                            <h1 class="h5" style="height: 68px; ">{{$n->name}}</h1>
                    </a>

                        <!-- KV giá sản phẩm -->
                        <div class="d-flex justify-content-center">
                            <!-- Giá bán -->
                            <div class="fw-bolder text-danger">{{number_format($n->price)}} vnđ</div>
                        </div>
                        <!-- KV button tương tác -->
                        <form action="{{route('add-cart')}}" method="post">
                            <input type="hidden" name="id" value="{{$n->id}}">
                            <input type="hidden" name="name" value="{{$n->name}}">
                            <input type="hidden" name="price" value="{{$n->price}}">
                            <input type="hidden" name="image" value="{{$n->image}}">
                            <input type="hidden" name="category" value="{{$n->category_name}}">
                            <button onclick="return alert('thêm vào giỏ thành công')" type="submit" name="them" class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i
                                        class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach



    </div>
    <div class="row">
        <div class="d-flex justify-content-between mt-4">
            <h1 class="h4 text-black-50">Sản phẩm bán chạy</h1>
            <a href="" class="nav-link">
                <h1 class="h4 text-black-50 "><i class="fa-solid fa-chevron-left"></i> Xem thêm</h1>
            </a>
        </div>
        <div class="col-3">
            <!-- box hiển thị sản phẩm -->
            <a href="" class="nav-link">
                <div class="border mt-3 mb-3 rounded overflow-hidden">
                    <!-- Khu vực ảnh -->
                    <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                        <img src="img/bc4.webp" alt="" class="mh-100 mw-100">
                    </div>
                    <div class="m-2">
                        <!-- Kv tên sản phẩm -->
                        <h1 class="h5" style="height: 68px; ">Áo Polo Nữ Cafe Đá In Sườn</h1>

                        <!-- KV giá sản phẩm -->
                        <div class="d-flex justify-content-between">
                            <!-- Giá niêm yết -->
                            <div class="text-decoration-line-through">199.000đ</div>
                            <!-- Giá bán -->
                            <div class="fw-bolder text-danger">119.000đ</div>
                        </div>
            </a>
            <!-- KV button tương tác -->
            <button class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i
                        class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
        </div>
    </div>
    </div>
    <div class="col-3">
        <!-- box hiển thị sản phẩm -->
        <a href="chitietsanpham.html" class="nav-link">
            <div class="border mt-3 mb-3 rounded overflow-hidden">
                <!-- Khu vực ảnh -->
                <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                    <img src="img/bc3.webp" alt="" class="mh-100 mw-100">
                </div>
                <div class="m-2">
                    <!-- Kv tên sản phẩm -->
                    <h1 class="h5" style="height: 68px; ">Áo Polo Thể Thao Nam Airycool Siêu Mát</h1>

                    <!-- KV giá sản phẩm -->
                    <div class="d-flex justify-content-between">
                        <!-- Giá niêm yết -->
                        <div class="text-decoration-line-through">219.000đ</div>
                        <!-- Giá bán -->
                        <div class="fw-bolder text-danger">119.000đ</div>
                    </div>
        </a>
        <!-- KV button tương tác -->
        <button class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i class="fa-solid fa-cart-plus"></i>
            Thêm vào giỏ</button>
    </div>
    </div>
    </div>
    <div class="col-3">
        <!-- box hiển thị sản phẩm -->
        <a href="chitietsanpham.html" class="nav-link">
            <div class="border mt-3 mb-3 rounded overflow-hidden">
                <!-- Khu vực ảnh -->
                <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                    <img src="img/bc2.webp" alt="" class="mh-100 mw-100">
                </div>
                <div class="m-2">
                    <!-- Kv tên sản phẩm -->
                    <h1 class="h5" style="height: 68px; ">Áo Polo Thể Thao Nữ Airycool Điều Hoà Phối Lé Nổi
                        Bật</h1>

                    <!-- KV giá sản phẩm -->
                    <div class="d-flex justify-content-between">
                        <!-- Giá niêm yết -->
                        <div class="text-decoration-line-through">419.000đ</div>
                        <!-- Giá bán -->
                        <div class="fw-bolder text-danger">319.000đ</div>
                    </div>
        </a>
        <!-- KV button tương tác -->
        <button class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i class="fa-solid fa-cart-plus"></i>
            Thêm vào giỏ</button>
    </div>
    </div>
    </div>
    <div class="col-3">
        <!-- box hiển thị sản phẩm -->
        <a href="chitietsanpham.html" class="nav-link">
            <div class="border mt-3 mb-3 rounded overflow-hidden">
                <!-- Khu vực ảnh -->
                <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                    <img src="img/bc1.webp" alt="" class="mh-100 mw-100">
                </div>
                <div class="m-2">
                    <!-- Kv tên sản phẩm -->
                    <h1 class="h5" style="height: 68px; ">Quần Thể Thao Nữ Biker In Training</h1>

                    <!-- KV giá sản phẩm -->
                    <div class="d-flex justify-content-center">
                        <!-- Giá bán -->
                        <div class="fw-bolder text-danger">219.000đ</div>
                    </div>
        </a>
        <!-- KV button tương tác -->
        <button class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i class="fa-solid fa-cart-plus"></i>
            Thêm vào giỏ</button>
    </div>
    </div>
    </div>
    </div>
    <div class="bg-warning d-flex align-items-center justify-content-center" style="height: 406px;">
        <img src="public/img/banner 2.jpg" alt="" class="mh-100 mw-100">
    </div>
    <div class="row">
        <div class="d-flex justify-content-between mt-4">
            <h1 class="h4 text-black-50">Trẻ em</h1>
            <a href="{{ route('menu/'."4") }}" class="nav-link">
                <h1 class="h4 text-black-50 "><i class="fa-solid fa-chevron-left"></i> Xem thêm</h1>
            </a>
        </div>

       @foreach($kids as $kid)
            <div class="col-md-3">
                <!-- box hiển thị sản phẩm -->
                <a href="chitietsanpham.html" class="nav-link">
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <!-- Khu vực ảnh -->
                        <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                            <img src="{{$kid->image}}" alt="" class="mh-100 mw-100">
                        </div>
                        <div class="m-2">
                            <!-- Kv tên sản phẩm -->
                            <h1 class="h5" style="height: 68px; ">{{$kid->name}}
                            </h1>

                            <!-- KV giá sản phẩm -->
                            <div class="d-flex justify-content-center">
                                <!-- Giá bán -->
                                <div class="fw-bolder text-danger">{{number_format($kid->price)}} vnđ</div>
                            </div>
                </a>
                <!-- KV button tương tác -->
                <button class="btn btn-warning w-100 rounded-pill fw-bold text-white"><i
                            class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
            </div>
    </div>
    </div>
       @endforeach
    </div>
@endsection