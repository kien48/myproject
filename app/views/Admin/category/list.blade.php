@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Quản lý danh mục</h3>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route("admin/category/add")}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới danh mục</a>
    </div>
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
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $value)
                <tr>
                    <th>{{$value->id}}</th>
                    <td>{{$value->name}}</td>
                    <td class="text-nowrap" style="width: 1px;">
                        <a href="{{route('admin/category/update/'.$value->id)}}"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Sửa</button></a>
                        <a class="btn btn-outline-danger" href="{{route('admin/category/delete/'.$value->id)}}" onclick="return confirm('xóa danh mục {{$value->name}} nhé?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection