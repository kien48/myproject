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
                    <div class="border mt-3 mb-3 rounded overflow-hidden  bg-light">
                        <!-- Khu vực ảnh -->
                        <div class=" d-flex align-items-center justify-content-center" style="height: 398px;">
                            <div class="image-container">
                            <img src="../{{$m->image}}" alt="" class="mh-100 mw-100">
                            </div>
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

            <div class="container text-center mt-2">
                <div class="row">

                    @php
                        $usedColors = []; // Mảng lưu trữ các màu đã được sử dụng
                    @endphp

                    @foreach($bienThe as $item)
                        @if($item->idpro == $m->id)
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

@endsection