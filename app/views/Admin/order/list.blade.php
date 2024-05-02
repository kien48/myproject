@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Quản lý đơn hàng</h3>

    <div class="d-flex justify-content-between mb-3 mt-3">
        <a href="{{route('admin/order/status/0')}}" class="btn btn-secondary">Đơn hàng chờ xác nhận</a>
        <a href="{{route('admin/order/status/1')}}" class="btn btn-info">Đơn hàng đang chuẩn bị</a>
        <a href="{{route('admin/order/status/2')}}" class="btn btn-primary">Đơn hàng đang giao</a>
        <a href="{{route('admin/order/status/3')}}" class="btn btn-success">Đơn hàng đã giao</a>
        <a href="{{route('admin/order/status/4')}}" class="btn btn-danger">Đơn hàng đã hủy</a>
    </div>
        <form class="d-flex" method="get" action="{{route('admin/order/1')}}">
            <input class="form-control me-2" type="text" placeholder="Tìm theo ID" name="id">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </form>


    @php
        // Lấy URL hiện tại từ biến siêu toàn cục $_SERVER['REQUEST_URI'] và lưu vào biến $url
        $url = $_SERVER['REQUEST_URI'];
        // Sử dụng hàm explode để tách chuỗi URL thành một mảng các phần tử dựa trên dấu gạch chéo ("/")
        $parts = explode("/", $url);
        // Lấy phần tử cuối cùng của mảng $parts, tức là phần cuối cùng trong đường dẫn URL
        $number = end($parts);
    @endphp
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tài khoản</th>
                <th>Tên người đặt</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Hình thức thanh toán</th>
                <th>Đơn vị vận chuyển</th>
                <th>Ghi chú</th>
                <th>Áp dụng mã giảm giá</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $value)
                @php
                    switch ($value->status) {
                        case 0:
                            $status = "Chờ xác nhận";
                            $class = "secondary";
                            break;
                        case 1:
                            $status = "Đang chuẩn bị hàng";
                            $class = "info";
                            break;
                        case 2:
                            $status = "Đang giao";
                            $class = "primary";
                            break;
                        case 3:
                            $status = "Đã nhận hàng";
                            $class = "success";
                            break;
                        case 4:
                            $status = "Đã hủy";
                            $class = "danger";
                            break;
                        default:
                            $status = "Trạng thái không xác định";
                            $class = "default";
                            break;
                    }
                @endphp

                <tr>
                    <th>{{$value->id}}</th>
                    <th>{{ $value->username }}</th>
                    <td>{{$value->customer_name}}</td>
                    <td>{{substr($value->customer_address, 0, 30)}}</td>
                    <td >
                        {{$value->customer_phone}}
                    </td>
                    <td>{{number_format($value->total_amount)}}đ</td>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->payment}}</td>
                    <td>{{$value->ship}}</td>
                    <td>{{$value->note}}</td>
                    <td>{{$value->percent_discount}}%</td>

                    <td>
                        <span class="badge bg-{{$class}}">{{$status}}</span>
                    </td>
                    <td class="text-nowap" style="width: 1px">
                        <div class="d-flex">
                            <a href="{{route('admin/order/detail/'.$value->id)}}"><button class="btn btn-outline-primary"> <i class="fa-solid fa-eye"></i> Chi
                                    tiết</button></a>
                            <a href="{{route('admin/order/detail/update/'.$value->id)}}"><button class="btn btn-outline-warning ms-2"><i class="fa-solid fa-wrench"></i> Cập nhật</button></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(!isset($_GET['id']))
            <div class="d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        @if ($number > 1)
                            <li class="page-item"><a class="page-link" href="{{ route('admin/order/'.($number - 1)) }}">Lùi</a></li>
                        @endif

                        @for($i = 1; $i <= $sotrang; $i++) <li class="page-item {{ ($number ?? 1) == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('admin/order/'.$i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        @if ($number < $sotrang) <li class="page-item"><a class="page-link" href="{{ route('admin/order/'.($number + 1)) }}">Tiến</a></li>
                        @endif
                    </ul>

                </nav>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
