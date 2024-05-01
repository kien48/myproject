@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Cập nhật mã giảm giá</h3>
        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($_SESSION['errors'] as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($_SESSION['success']) && isset($_GET['msg']))
            <div class="alert alert-success" role="alert">
                <span>{{$_SESSION['success']}}</span>
            </div>
        @endif
        <form method="post" action="{{route('admin/discount/update')}}" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-12">
                    <span class="form-label">Phần trăm giảm giá:</span>
                    <input type="number" class="form-control" name="percent" value="{{$one->percent}}" disabled>
                    <input type="hidden" class="form-control" name="percent" value="{{$one->percent}}" >
                    <input type="hidden" class="form-control" name="start_day" value="{{$one->start_day}}" >
                    <input type="hidden" class="form-control" name="id" value="{{$one->id}}" >
                    <input type="hidden" class="form-control" name="code" value="{{$one->code}}" >
                </div>
                <div class="col-md-12">
                    <span class="form-label">Ngày bắt đầu:</span>
                    <input type="date" class="form-control"  value="{{date('Y-m-d', strtotime($one->start_day))}}" disabled>
                </div>
                <div class="col-md-12">
                    <span class="form-label">Ngày hết hạn:</span>
                    <input type="date" class="form-control" name="expiration" value="{{ date('Y-m-d', strtotime($one->expiration)) }}">
                </div>
                <div class="col-md-12">
                    <span class="form-label">Số lượng:</span>
                    <input type="number" class="form-control" name="quantity" value="{{$one->quantity}}">
                </div>

            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('admin/list-discount/1')}}" class="btn btn-outline-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh
                    sách</a>
                <button type="submit" name="add" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Cập nhật</button>

            </div>
        </form>
    </div>
@endsection


