@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Thêm mới danh mục</h3>
    <form action="">
        <div>
            <span class="form-label">Tên danh mục:</span>
            <input type="text" class="form-control">
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="list.html" class="btn btn-outline-secondary " style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh
                sách</a>
            <button type="submit" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Tạo mới</button>
        </div>
    </form>
</div>
@endsection