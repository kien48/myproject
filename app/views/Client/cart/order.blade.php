@extends("layout.main")

@section("content")
    <div class="row mt-5 bg-light">
        <div class="col-md-5">
            <div>
                <h1 class="h3">Thông tin giao hàng</h1>
            </div>
            <form action="{{ route("add-order") }}" method="post">
                <input type="text" class="form-control mt-2" name="name" placeholder="Họ và tên" value="{{ $_SESSION['user']->username }}">
                <input type="text" class="form-control mt-2" name="phone" placeholder="Số điện thoại" value="{{ $_SESSION['user']->phone }}">
                <input type="text" class="form-control mt-2" name="address" placeholder="Địa chỉ" value="{{ $_SESSION['user']->address }}">
                <textarea name="note" id="" cols="30" rows="10" placeholder="Ghi chú" class="form-control mt-2"></textarea>
        </div>
        <div class="col-md-3">
            <div>
                <h1 class="h3">Đơn vị vận chuyển</h1>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="size_radio2" name="ship" value="Giao hàng nhanh" checked required><i class="fa-solid fa-truck-fast"></i>
                @if($_SESSION['total'] < 1000000)
                    Giao hàng nhanh (+30k)
                    @else
                    Giao hàng nhanh (freeship)
                @endif
                <label class="form-check-label" for="size_radio2"></label>
            </div>
            <div>
                <h1 class="h3 mt-3">Thanh toán</h1>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="color_radio1" name="pay" value="color_option1"><i class="fa-regular fa-credit-card"></i> Thanh toán momo
                <label class="form-check-label" for="color_radio1"></label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="color_radio2" name="pay" value="Thanh toán khi nhận (COD)" checked><i class="fa-solid fa-money-bill"></i> Thanh toán khi nhận (COD)
                <label class="form-check-label" for="color_radio2"></label>
            </div>
        </div>
        <div class="col-md-4">
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
                    $total += $money;
                @endphp
                <table class="table">
                    <tr>
                        <td style="width: 40px; height: 40px;" class="border rounded bg-light d-flex justify-content-center align-items-center">
                            <img src="{{ $image }}" alt="" class="mh-100 mw-100">
                        </td>
                        <td>
                            {{ $name }} <br>
                            <p class="text-black-50">Số lượng: {{ $quantity }}</p>
                        </td>
                        <td>{{ number_format($money) }} đ</td>
                        <td>{{$size[0] }}</td>
                        <td>{{ $color[0] }}</td>
                    </tr>
                </table>
            @endforeach
            @if(isset($_SESSION['user']))
                <div class="mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" placeholder="Nhập mã giảm giá" class="form-control" name="code">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="apply" class="btn btn-outline-primary">Áp dụng</button>
                        </div>


                        <h6 class=" mt-1 mb-1">{{$status}}</h6>
                    </div>
                </div>
            @else
                <div class="mt-1 mb-3">
                    <h6 class="text-black-50">* đăng nhập để áp dụng được và nhận mã giảm giá</h6>
                </div>
            @endif
            <div class="d-flex justify-content-between mt-3 mb-3">
                <h1 class="h4">Tổng cộng:</h1>
                @if(!isset($totalCompleted))
                    @php if ($total >= 1000000){
                            $tong = $total;
                         }else{
                              $tong = $total + 30000;
                         } @endphp
                    <h1 class="h4">{{ number_format($tong) }} đ</h1>
                    <input type="hidden" name="total" value="{{$tong }}">
                @else
                    <h1 class="h4">{{ number_format($totalCompleted ) }} đ</h1>
                    <input type="hidden" name="totalCompleted" value="{{ $totalCompleted}}">
                    <input type="hidden" name="percent_discount" value="{{$matchedPercent}}">
                    <input type="hidden" name="id_code" value="{{$matchedId}}">
                @endif
                <input type="hidden" name="percent_discount" value="0">
                <input type="hidden" name="id_code" value="0">
            </div>

            <div class="d-flex align-items-center justify-content-around">
                <a href="{{ route('list-cart') }}" class="nav-link"><i class="fa-solid fa-angle-left"></i> Quay về giỏ hàng</a>
                <button class="btn btn-warning" style="width: 100px;" name="submit">Đặt hàng</button>
            </div>
        </div>
    </div>
    </form>
@endsection
