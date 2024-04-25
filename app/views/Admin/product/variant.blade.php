@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý biến thể sản phẩm</h3>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('admin/form-add')}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới biến thể sản phẩm</a>
        </div>
        @if(isset($_SESSION['success']) && isset($_GET['msg']))
            <div class="alert alert-success" role="alert">
                <span>{{$_SESSION['success']}}</span>
            </div>
    @endif

@endsection
