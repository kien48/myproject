@extends("layout.main")
@section("content")
<div class="container mt-4">
    <h1 class="h3 text-center mb-4">Trang danh sách các sản phẩm trong đơn hàng</h1>
    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
    <div class="alert alert-danger" role="alert">
        <span>{{$_SESSION['errors']}}</span>
    </div>
    @endif

    @if(isset($_SESSION['success']) && isset($_GET['msg']))
    <div class="alert alert-success" role="alert">
        <span>{{$_SESSION['success']}}</span>
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Mã hóa đơn</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th>
                    <th>Cỡ</th>
                    <th>Màu</th>
                </tr>
            </thead>
            <tbody>
                <form action="{{route('huy')}}" method="post">
                    @php $key = 1 @endphp
                    @foreach($order as $item)
                    <tr class="table">
                        <td>{{$key++}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->price)}}đ</td>
                        <td>{{number_format($item->total)}}đ</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->color}}</td>
                    </tr>
                    <input type="hidden" name="invoice_id" id="" value="{{$item->id}}">
                    <input type="hidden" name="id_product[]" id="" value="{{$item->id_product}}">
                    <input type="hidden" name="quantity[]" id="" value="{{$item->quantity}}">
                    <input type="hidden" name="size[]" id="" value="{{$item->size}}">
                    <input type="hidden" name="color[]" id="" value="{{$item->color}}">
                    @endforeach
            </tbody>
        </table>
    </div>
    @if( $orderID->status == 1)
    <button class="btn btn-danger w-100" type="submit" name="huy" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng không?')">Hủy đơn</button>
    @elseif($orderID->status == 4)
    <button class="btn btn-danger w-100" type="button">Đơn này đã bị hủy</button>
    @elseif($orderID->status == 3)
    <button class="btn btn-success w-100" type="button">Đơn này đã hoàn tất</button>
    @elseif($orderID->status == 2)
    <button class="btn btn-info w-100" type="button">Đang giao hàng vui lòng chú ý điện thoại</button>
    @endif
    </form>
    <a href="{{route('list-order')}}">Về trang hóa đơn</a>
</div>

@endsection