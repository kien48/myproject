@extends("layout.main")
@section("content")
    <div class="row mt-5 bg-light">
        <div class="col-5">
            <div>
                <h1 class="h3">Thông tin giao hàng</h1>
            </div>
            <form action="">
                <input type="text" class="form-control mt-2" placeholder="Họ và tên" value="{{$_SESSION['user']->username}}">
                <input type="text" class="form-control mt-2" placeholder="Số điện thoại" value="{{$_SESSION['user']->phone}}">
                <input type="text" class="form-control mt-2" placeholder="Địa chỉ" value="{{$_SESSION['user']->address}}">
                <textarea name="" id="" cols="30" rows="10" placeholder="Ghi chú"
                          class="form-control mt-2"></textarea>

        </div>
        <div class="col-3">
            <div>
                <h1 class="h3">Đơn vị vận chuyển</h1>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="size_radio1" name="size_radio"
                       value="size_option1" checked><i class="fa-solid fa-truck"></i> Giao hành tiết kiệm
                <label class="form-check-label" for="size_radio1"></label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="size_radio2" name="size_radio"
                       value="size_option2"><i class="fa-solid fa-truck-fast"></i> Giao hàng nhanh
                <label class="form-check-label" for="size_radio2"></label>
            </div>
            <div>
                <h1 class="h3 mt-3">Thanh toán</h1>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="color_radio1" name="color_radio"
                       value="color_option1"><i class="fa-regular fa-credit-card"></i> Thanh toán momo
                <label class="form-check-label" for="color_radio1"></label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="color_radio2" name="color_radio"
                       value="color_option2" checked><i class="fa-solid fa-money-bill"></i> Thanh toán khi nhận
                (COD)
                <label class="form-check-label" for="color_radio2"></label>
            </div>
        </div>
        <div class="col-4 ">
            <div>
                <h1 class="h3">Đơn hàng</h1>
            </div>
            @php
                $total = 0;
            @endphp
            @foreach($_SESSION['giohang'] as $cart)
                @php
                    extract($cart);
                  $money = $price * $quantity;
                  $total+=$money;
                @endphp
                <div class="d-flex align-items-center">
                    <div style="width: 40px;height: 40px;"
                         class="border rounded bg-light d-flex justify-content-center align-items-center">
                        <img src="{{$image}}" alt="" class="mh-100 mw-100 ">
                    </div>
                    <h6 style="margin-left: 10px;">{{$name}}
                        <p class="text-black-50">Số lượng : {{$quantity}}</p>
                    </h6>
                    <h5 class="ms-4">{{number_format($money)}} đ</h5>
                </div>
            @endforeach

            <div class="d-flex justify-content-between mt-3 mb-3">
                <h1 class="h4">Tổng cộng:</h1>
                <h1 class="h4">{{number_format($total)}} đ</h1>
            </div>
            <div class="d-flex align-items-center justify-content-around">
                <a href="{{route('list-cart')}}" class="nav-link"><i class="fa-solid fa-angle-left"></i> Quay về giỏ
                    hàng</a>
                <button class="btn btn-warning" style="width: 100px;">Đặt hàng</button>
            </div>
        </div>
    </div>
@endsection
