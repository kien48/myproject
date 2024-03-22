@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Thêm mới sản phẩm</h3>
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
        <form method="post" action="{{route('admin/post-product')}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <span class="form-label">Tên:</span>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-12">
                    <span class="form-label">Giá:</span>
                    <input type="text" class="form-control" name="price">
                </div>
                <div class="col-md-6">
                    <span class="form-label">Ảnh 1:</span>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="col-md-6">
                    <span class="form-label">Ảnh 2:</span>
                    <input type="file" class="form-control" name="image2">
                </div>
                <div class="col-md-6">
                    <span class="form-label">Danh mục:</span>
                    <select id="" class="form-select" name="id_ct">
                        <option value="0">Chọn</option>
                        @foreach($categories as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>

                        @endforeach
                    </select>

                </div>
                <div class="col-md-6">
                    <span class="form-label">Mô tả:</span>
                    <textarea name="description" id="" cols="10" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('admin/list-product')}}" class="btn btn-outline-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh
                    sách</a>
                <button type="submit" name="add" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Tạo mới</button>

            </div>
        </form>
    </div>
@endsection

