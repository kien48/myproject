@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Quản lý danh mục</h3>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route("admin/category/add")}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới danh mục</a>
    </div>
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
                        <a href="update.html"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Sửa</button></a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#myModal"><i class="fa-solid fa-trash"></i>
                            Xóa
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection