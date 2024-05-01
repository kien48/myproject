@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Quản lý đơn hàng</h3>
    <div class="d-flex justify-content-between mb-2">
        <form method="get" action="{{ route('admin/order/1') }}" class="d-flex align-items-center">
            <select class="form-select me-2" name="key">
                <option value="1" {{ (isset($_GET['key']) && $_GET['key'] == '1') ? 'selected' : '' }}>Tất cả</option>
                <option value="2" {{ (isset($_GET['key']) && $_GET['key'] == '2') ? 'selected' : '' }}>Ngày hôm nay</option>
                <option value="3" {{ (isset($_GET['key']) && $_GET['key'] == '3') ? 'selected' : '' }}>Tuần này</option>
                <option value="4" {{ (isset($_GET['key']) && $_GET['key'] == '4') ? 'selected' : '' }}>Tháng này</option>
            </select>
            <button class="btn btn-primary" type="submit">OK</button>
        </form>


        <a href="{{ route('admin/category/add') }}" class="btn btn-outline-danger ms-4 align-self-center">
            <i class="fa-solid fa-chart-column me-2"></i> Thống kê đơn hàng
        </a>
    </div>

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
                <th>ID user</th>
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

                if($value->status == 1){
                    $status = "Đang chuẩn bị hàng";
                     $class= "info";
                }elseif($value->status == 2){
                    $status = "Đang giao";
                     $class= "primary";
                }elseif($value->status == 3){
                    $status = "Đã nhận hàng";
                     $class= "success";
                }elseif($value->status == 4){
                    $status = "Đã hủy";
                     $class= "danger";
                }
                @endphp
                <tr>
                    <th>{{$value->id}}</th>
                    <th>{{$value->id_user}}</th>
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
                        <a href="{{route('admin/order/detail/'.$value->id)}}"><button class="btn btn-outline-primary"> <i class="fa-solid fa-eye"></i> Chi
                                tiết</button></a>
                        <a href="{{route('admin/order/detail/update/'.$value->id)}}"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Sửa</button></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
    </div>
</div>
@endsection
