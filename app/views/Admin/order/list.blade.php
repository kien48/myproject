@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Quản lý đơn hàng</h3>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route("admin/category/add")}}" class="btn btn-outline-danger "><i class="fa-solid fa-chart-column"></i> Thống kê đơn hàng</a>
    </div>
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
                        <span class="badge bg-warning">{{$value->status}}</span>
                    </td>
                    <td >
                        <a href="detail.html"><button class="btn btn-outline-primary"> <i class="fa-solid fa-eye"></i> Chi
                                tiết</button></a>
                        <a href="update.html"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Sửa</button></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Lùi</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Tiến</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
