@extends("layout.main")
@section("content")
    <div class="row">
        <div class="d-flex justify-content-center mt-2">
            <h1 class="h3">Danh mục {{$oneCT->name}}</h1>
        </div>
        @php $category = "" @endphp
        @foreach($menu as $m)
            @php $category = "" @endphp
            <div class="col-md-3">
                <!-- box hiển thị sản phẩm -->
                <a href="{{route('detail/'.$m->id)}}" class="nav-link">
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <!-- Khu vực ảnh -->
                        <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                            <img src="../{{$m->image}}" alt="" class="mh-100 mw-100">
                        </div>
                        <div class="m-2">
                            <!-- Kv tên sản phẩm -->
                            <h1 class="h5" style="height: 68px; ">{{$m->name}}</h1>
                </a>
                <!-- KV giá sản phẩm -->
                <div class="d-flex justify-content-center">
                    <!-- Giá bán -->
                    <div class="fw-bolder text-danger">{{number_format($m->price)}} vnđ</div>
                </div>

            </div>
    </div>

    </div>
    @endforeach
    </div>

@endsection