@extends('layout.main')
@section("content")
    <div class="row">
        <div class="d-flex justify-content-center mt-4">
            <h1 class="h5 text-black-50">Tìm kiếm</h1>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <h1 class="h3">KẾT QUẢ TÌM KIẾM "{{$keyword}}"</h1>
        </div>
       @foreach($searchResults as $search)
            <div class="col-md-3">
                <!-- box hiển thị sản phẩm -->
                <a href="{{route('detail/'.$search->id)}}" class="nav-link">
                    <div class="border mt-3 mb-3 rounded overflow-hidden">
                        <!-- Khu vực ảnh -->
                        <div class=" d-flex align-items-center justify-content-center" style="height: 406px;">
                            <img src="{{$search->image}}" alt="" class="mh-100 mw-100">
                        </div>
                        <div class="m-2">
                            <!-- Kv tên sản phẩm -->
                            <h1 class="h5" style="height: 68px; ">{{$search->name}}</h1>
                </a>
                            <!-- KV giá sản phẩm -->
                            <div class="d-flex justify-content-center">
                                <!-- Giá bán -->
                                <div class="fw-bolder text-danger">{{number_format($search->price)}} vnđ</div>
                            </div>

                        </div>
                    </div>

            </div>
       @endforeach

    </div>
    </div>
@endsection
