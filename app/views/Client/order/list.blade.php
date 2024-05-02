@extends("layout.main")

@section("content")

  @if(empty($listOrder))
    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="text-center">
            <h1 class="error-code h1 text-warning display-1 mt-5">Chưa có đơn hàng nào</h1>
            <p class="error-message h3 lead mb-5 mt-2">Vui lòng mua hàng ạ</p>
            <a href="{{ route('/') }}" class="btn btn-outline-danger">Quay lại Trang chủ</a>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="container mt-4">
      <h1 class="h3 text-center mb-4">Danh sách đơn hàng</h1>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-light">
          <tr>
            <th>Mã hóa đơn</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Ngày tạo</th>
            <th>Ghi chú</th>
            <th>Vận chuyển</th>
            <th>Thanh toán</th>
            <th>Giảm giá</th>
            <th>Trạng thái</th>
            <th>Tương tác</th>
          </tr>
          </thead>
          <tbody>
          @foreach($listOrder as $order)
            @php
              $class = '';
              $name_status = '';
              switch($order->status) {
                  case 0:
                  $name_status = "Chờ xác nhận";
                  $class = "secondary";
                  break;
                case 1:
                  $name_status = "Đang chuẩn bị hàng";
                  $class = "info";
                  break;
                case 2:
                  $name_status = "Đang giao hàng";
                  $class = "warning";
                  break;
                case 3:
                  $name_status = "Đã giao hàng";
                  $class = "success";
                  break;
                case 4:
                  $name_status = "Đơn hàng đã bị hủy";
                  $class = "danger";
                  break;
                default:
                  $name_status = "Không xác định";
                  $class = "default";
              }
            @endphp
            <tr class="table-{{$class}}">
              <td>{{$order->id}}</td>
              <td>{{$order->customer_name}}</td>
              <td>{{$order->customer_phone}}</td>
              <td>{{$order->customer_address}}</td>
              <td>{{number_format($order->total_amount)}}đ</td>
              <td>{{$order->created_at}}</td>
              <td>{{$order->note}}</td>
              <td>{{$order->ship}}</td>
              <td>{{$order->payment}}</td>
              <td>{{$order->percent_discount}}%</td>
              <td>{{$name_status}}</td>
              <td>
                <a href="{{route('detail-order/'.$order->id)}}" class="btn btn-primary btn-sm w-100 mt-1">Chi tiết</a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection
