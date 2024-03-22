@extends("layout.main")
@section("content")
    @if(!empty($_SESSION['giohang']))
    <div class="row ">
        <div class="col-md-7 bg-light-subtle rounded-2 mt-4" style="margin-right: 0px;">
            <h1 class="h4">Giỏ hàng</h1>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                    </thead>
                    <tbody>
                    @php
                        $total = 0;
                        $stt = 0;
                    @endphp
                    @foreach($_SESSION['giohang'] as $key=>$pro)
                        @php
                            extract($pro);
                          // Chuyển chuỗi sang số (nếu cần)
$price = (float)$price; // hoặc (int)$price tùy vào kiểu dữ liệu của giá sản phẩm
$quantity = (int)$quantity;

// Thực hiện phép nhân
$money = $price * $quantity;

// Cập nhật tổng tiền
$total += $money;

                        @endphp
                        <tr>
                            <td>{{$stt+1}}</td>
                            <td>{{$pro['name']}}</td>
                            <td>
                                <div style="width: 40px;height: 40px;"
                                     class="border rounded bg-light d-flex justify-content-center align-items-center">
                                    <img src="{{$image}}" alt="" class="mh-100 mw-100 ">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-outline-black ">-</button>
                                    <input type="text" class="form-control text-center " style="max-width: 60px"
                                           value="{{$quantity}}" min="1">
                                    <button class="btn btn-outline-black ">+</button>
                                </div>
                            </td>
                            <td>{{number_format($price)}} đ</td>
                            <td>{{number_format($money)}} đ</td>
                            <td>
                                <button class="btn btn-outline-danger border-0"><i
                                            class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                  <td colspan="7"><a href="{{route("delete-cart")}}"><button class="btn btn-outline-danger" ><i
                                      class="fa-solid fa-trash"></i> Xóa giỏ hàng</button></a></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4 bg-light-subtle rounded-2 mt-4">
            <div class="d-flex justify-content-between">
                <h1 class="h4">Tổng tiền đơn hàng:</h1>
                <h1 class="h4">{{number_format($total)}} đ</h1>
            </div>
            <div class="mt-2">
                <a href="{{route('order')}}"><button class="w-100 btn btn-warning"><i class="fa-solid fa-money-bill-1-wave"></i> Thanh toán
                        ngay</button></a>
            </div>
            <div>
                <h6 class="fw-normal mt-5"><i class="fa-solid fa-tag"></i> Sử dụng mã giảm giá ở bước
                    thanh toán</h6>
                    <h6 class="fw-normal mt-3"><i class="fa-solid fa-shield-halved"></i> Thông tin bảo mật và
                        mã hóa</h1>
                        <h6 class="fw-normal mt-3"><i class="fa-solid fa-truck-fast"></i> <strong>Giao
                                hàng:</strong> Từ 1 - 3 ngày</h1>
                            <h6 class="fw-normal mt-3"><i class="fa-solid fa-retweet"></i> <strong>Miễn phí đổi
                                    trả:</strong> tại 250+ cửa hàng trong 15 ngày</h6>
            </div>
        </div>
    </div>
    @else
        <h5>Giỏ hàng đang rỗng</h5>
    @endif
@endsection