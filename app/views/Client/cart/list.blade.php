@extends("layout.main")
@section("content")
@if(!empty($_SESSION['giohang']))

<div class="row ">
    <div class="col-md-8 bg-light-subtle rounded-2 mt-4" style="margin-right: 0px;">
        <h1 class="h4">Giỏ hàng</h1>
        <div class="table-responsive">
            <table class="table text-center ">
                <thead>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Số lượng</th>
                    <th>Màu</th>
                    <th>Cỡ</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    $count = 1;
                    @endphp
                    @foreach($_SESSION['giohang'] as $key => $pro)
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
                        <td>{{$count++}}</td>
                        <td><a href="{{route('detail/'.$id)}}" class="nav-link">{{$pro['name']}}</a></td>
                        <td>
                            <div style="width: 40px;height: 40px;" class="border rounded bg-light d-flex justify-content-center align-items-center">
                                <img src="{{$image}}" alt="" class="mh-100 mw-100 ">
                            </div>
                        </td>
                        <td>
                            <form method="post" action="{{route('update-quantity-product-cart')}}">
                                <div class="d-flex">
                                    @php
                                    $mq = "";
                                    foreach ($maxQuantity as $max){
                                    if($max->idpro == $pro['id'] && $max->size == $pro['size'] && $max->color == $pro['color']){
                                    $mq = $max->quantity;
                                    }

                                    }

                                    if($quantity > $mq ){
                                    $_SESSION['giohang'][$key]['quantity'] = $mq;
                                    }
                                    if($_SESSION['giohang'][$key]['quantity'] == 0 ){
                                    $cl = "disabled";
                                    }else{
                                    $cl = "";
                                    }
                                    @endphp

                                    <input name="quantitynew[]" onkeyup="kiemtrasoluong(this)" type="number" class="form-control text-center" style="max-width: 90px" value="{{$_SESSION['giohang'][$key]['quantity']}}" min="1" max="{{$mq}}">
                                    <input name="id_product[]" type="hidden" value="{{$id}}">
                                    <input name="key[]" type="hidden" value="{{$keyID}}">
                                    <input name="color[]" type="hidden" value="{{$color}}">
                                    <input name="size[]" type="hidden" value="{{$size}}">
                                </div>
                        </td>
                        <td>{{$color}}</td>
                        <td>{{$size}}</td>

                        <td>{{number_format($price)}} đ</td>
                        <td>{{number_format($money)}} đ</td>
                        <td>
                            <a href="{{route('delete-cart-product/'.$key)}}" onclick="return confirm('xóa sản phẩm {{$name}} nhé')" class="btn btn-outline-danger border-0"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="4">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa-solid fa-trash"></i> Xóa giỏ hàng
                            </button>
                        </td>
                        <td colspan="5">
                            <button name="update_quantity" class="btn btn-outline-warning" type="submit">
                                <i class="fa-solid fa-wrench"></i> Cập nhật số lượng
                            </button>

                        </td>
                    </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <h6 class="text-black-50">* Nếu số lượng sản phẩm trong kho hết thì sản phẩm đó trong giỏ hàng sẽ bị xóa</h6>
            <h6 class="text-black-50">* Không thể tăng quá số lượng sản phẩm trong kho </h6>
        </div>
    </div>
    <div class="col-md-4 bg-light-subtle rounded-2 mt-4">
        <div class="d-flex justify-content-between">
            <h1 class="h4">Tổng tiền đơn hàng:</h1>
            <h1 class="h4">{{number_format($total)}} đ</h1>
            @php
            $_SESSION['total'] =$total;
            $freeShip = 1000000;
            $percent = $_SESSION['total']/$freeShip * 100;
            @endphp
        </div>
        @if($_SESSION['total'] < 1000000) <h6>Còn {{ number_format($freeShip -$_SESSION['total'])}}đ là được freeship nha</h6>
            @else
            <h6>Bạn đã được freeship</h6>
            @endif
            <div class="progress mt-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:{{$percent}}%">{{number_format($_SESSION['total'])}}đ</div>
            </div>
            <div class="mt-2">
                <a href="{{route('order')}}" class="w-100 btn btn-warning {{$cl}}">
                    <button class="w-100 btn btn-warning"><i class="fa-solid fa-money-bill-1-wave"></i> Thanh toán
                        ngay</button>
                </a>

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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1 class="error-code h1 text-warning display-1 mt-5">Giỏ hàng đang rỗng</h1>
                <p class="error-message h3 lead mb-5 mt-2">Vui lòng chọn thêm vào giỏ hàng </p>
                <a href="{{ route('/') }}" class="btn btn-outline-danger">Trở lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
@endif
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Xóa giỏ hàng</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa giỏ hàng không
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{route("delete-cart")}} " class="btn btn-danger"> Đồng ý</a>
            </div>

        </div>
    </div>
</div>


<div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật số lượng thành công</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



@endsection
<script>
    // Kiểm tra giá trị của biến $status khi trang được tải
    window.onload = function() {
        var status = <?php echo $status; ?>; // Gán giá trị của biến $status cho biến JavaScript

        // Kiểm tra nếu $status = 1, mở modal
        if (status === 1) {
            var myModal1 = new bootstrap.Modal(document.getElementById('myModal1')); // Lấy modal bằng ID
            myModal1.show(); // Hiển thị modal
        }

    }
</script>