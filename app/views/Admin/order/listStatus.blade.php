@extends('layout.main')

@section("content")
    @php
        switch ($status) {
            case 0:
                $statusOrder = "chờ xác nhận";
                break;
            case 1:
                $statusOrder = "đang chuẩn bị ";
                break;
            case 2:
                $statusOrder = "đang giao";
                break;
            case 3:
                $statusOrder = "đã nhận hàng";
                break;
            case 4:
                $status = "đã hủy";
                break;
            default:
                $statusOrder = "Trạng thái không xác định";
                break;
        }
    @endphp
    <div class="container mt-3">
        <h3 class="text-center mb-3">Quản lý đơn hàng {{$statusOrder}}</h3>
        <h5>Tổng : {{count($list)}} đơn hàng</h5>
        <div class="card shadow mb-4" style="height: 500px; overflow-y: auto;">
        <div class="row">
            @foreach($list as $value)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            Đơn hàng #{{$value->id}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$value->customer_name}}</h5>
                            <p class="card-text">Tổng tiền: {{number_format($value->total_amount)}}đ</p>
                            <p class="card-text">Ngày đặt: {{$value->created_at}}</p>
                            <p class="card-text">Trạng thái: {{$statusOrder}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('admin/order/detail/'.$value->id)}}" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i> Chi tiết</a>
                            <a href="{{route('admin/order/detail/update/'.$value->id)}}" class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Cập nhật</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        <div>
            <a href="{{route('admin/order/1')}}" class="btn btn-secondary">Danh sách toàn bộ đơn hàng</a>
        </div>
    </div>
@endsection
