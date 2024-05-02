@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Cập nhật đơn hàng</h3>
    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
        <div class="alert alert-danger" role="alert">
            <div class="alert alert-danger" role="alert">
                <span>{{$_SESSION['errors']}}</span>
            </div>
        </div>
    @endif
    @if(isset($_SESSION['success']) && isset($_GET['msg']))
        <div class="alert alert-success" role="alert">
            <span>{{$_SESSION['success']}}</span>
        </div>
    @endif
    <form action="{{route('admin/order/post')}}" method="post">
        <div class="row">
            <div class="col-md-12">
                <span class="form-label">Mã đơn hàng:</span>
                <input type="number" class="form-control" value="{{$order[0]->id}}" disabled>
                <input type="hidden" name="id" class="form-control" value="{{$order[0]->id}}" >
            </div>
            <div class="col-md-12">
                <span class="form-label">Tên Người đặt:</span>
                <input type="text" class="form-control" value="{{$order[0]->customer_name}}" disabled>
            </div>
            <div class="col-md-12">
                <span class="form-label">Địa chỉ:</span>
                <input type="text" class="form-control" value="{{$order[0]->customer_address}}" disabled>
            </div>
            <div class="col-md-6">
                <span class="form-label">Số điện thoại:</span>
                <input type="text" class="form-control" value="{{$order[0]->customer_phone}}" disabled>
            </div>
            <div class="col-md-6">
                <span class="form-label">Ngày đặt:</span>
                <input type="text" class="form-control" value="{{$order[0]->created_at}}" disabled>
            </div>
            <div class="col-md-6">
                <span class="form-label">Tổng tiền:</span>
                <input type="text" class="form-control" value="{{$order[0]->total_amount}}" disabled>
            </div>
            <div class="col-md-6">
                <span class="form-label">Trạng thái:</span>
                <select name="status" id="" class="form-select" {{ $order[0]->status == 4 ? 'disabled' : '' }} >
                    <option value="">Chọn</option>
                    <option value="1" {{ $order[0]->status == 1 ? 'selected' : '' }}>Đang chuẩn bị hàng</option>
                    <option value="2" {{ $order[0]->status == 2 ? 'selected' : '' }}>Đang giao</option>
                    <option value="3" {{ $order[0]->status == 3 ? 'selected' : '' }}>Đã giao</option>
                    <option value="4" {{ $order[0]->status == 4 ? 'selected' : '' }} disabled>Đã hủy</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{route('admin/order/1')}}" class="btn btn-outline-secondary " style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh
                sách</a>
           @if($order[0]->status != 4)
                <button type="submit" class="btn btn-outline-success " name="submit"><i class="fa-solid fa-wrench"></i> Cập nhật</button>
           @endif

        </div>
    </form>
</div>

@endsection