@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Thêm mới danh mục</h3>
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
    <form action="{{route('admin/post-category')}}" method="post">
        <div>
            <span class="form-label">Tên danh mục:</span>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{route('admin/category')}}" class="btn btn-outline-secondary " style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh
                sách</a>
            <button type="submit" class="btn btn-outline-success " name="submit"><i class="fa-solid fa-plus"></i> Tạo mới</button>
        </div>
    </form>
</div>
@endsection