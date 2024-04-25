@extends("layout.main")

@section("content")
    <!-- Banner -->
    <div id="demo" class="carousel slide overflow-hidden" data-bs-ride="carousel" style="max-height: 400px; overflow: hidden;">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="{{route('post/detail/'.$_SESSION['listSettings'][0]->link_bn_1)}}"><img src="{{ $_SESSION['listSettings'][0]->banner1 }}" class="d-block w-100" alt="Banner 1"></a>
            </div>

            <div class="carousel-item">
                <a href="{{route('post/detail/'.$_SESSION['listSettings'][0]->link_bn_2)}}"><img src="{{ $_SESSION['listSettings'][0]->banner2 }}" class="d-block w-100" alt="Banner 2"></a>
            </div>
            <div class="carousel-item">
                <a href="{{route('post/detail/'.$_SESSION['listSettings'][0]->link_bn_3)}}"> <img src="{{ $_SESSION['listSettings'][0]->banner3 }}" class="d-block w-100" alt="Banner 3"></a>
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

    <!-- Sản phẩm mới nhất -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h1 class="h4 text-black-50">Sản phẩm mới nhất</h1>
        </div>
        <div class="row">
            @foreach($new as $n)
                <div class="col-md-3 col-lg-3">
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <a class="nav-link" href="{{route('detail/'.$n->id)}}">
                            <div class="d-flex align-items-center justify-content-center" style="height: 406px;">
                                <img src="{{$n->image}}" alt="" class="mh-100 mw-100">
                            </div>
                            <div class="m-2">
                                <h1 class="h5" style="height: 68px;">{{$n->name}}</h1>
                        </a>
                        <div class="d-flex justify-content-center">
                            <div class="fw-bolder text-danger">{{number_format($n->price)}} vnđ</div>
                        </div>
                        <form action="{{route('add-cart')}}" method="post">
                            <!-- Form tương tác -->
                        </form>
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
                <div class="col-md-3">
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <a href="{{route('detail/'.$best->id_product)}}" class="nav-link">
                            <div class="d-flex align-items-center justify-content-center" style="height: 406px;">
                                <img src="{{$best->image}}" alt="" class="mh-100 mw-100">
                            </div>
                            <div class="m-2">
                                <h1 class="h5" style="height: 68px;">{{$best->product_name}}</h1>
                        </a>
                        <div class="d-flex justify-content-center">
                            <div class="fw-bolder text-danger">{{number_format($best->price)}} vnđ</div>
                        </div>
                        <form action="{{route('add-cart')}}" method="post">
                            <!-- Form tương tác -->
                        </form>
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
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <a href="{{route('detail/'.$kid->id)}}" class="nav-link">
                            <div class="d-flex align-items-center justify-content-center" style="height: 406px;">
                                <img src="{{$kid->image}}" alt="" class="mh-100 mw-100">
                            </div>
                            <div class="m-2">
                                <h1 class="h5" style="height: 68px;">{{$kid->name}}</h1>
                        </a>
                        <div class="d-flex justify-content-center">
                            <div class="fw-bolder text-danger">{{number_format($kid->price)}} vnđ</div>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    </div>


@endsection
