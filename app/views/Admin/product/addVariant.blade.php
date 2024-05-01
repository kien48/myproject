@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Thêm mới biến thể sản phẩm</h3>

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

        <form method="post" action="{{route('admin/post-variant')}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="id_pro" class="form-label">ID sản phẩm:</label>
                        <input type="text" class="form-control" name="pro_id" value="{{$id}}" disabled>
                        <input type="hidden" class="form-control" name="pro_id" value="{{$id}}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="color" class="form-label">Màu:</label>
                        <select  class="form-select" id="size" name="color">
                            <option value="">- Lựa chọn -</option>
                            <option value="Đỏ">Đỏ</option>
                            <option value="Xanh">Xanh</option>
                            <option value="Đen">Đen</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Hồng">Hồng</option>
                            <option value="Vàng">Vàng</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="size" class="form-label">Kích cỡ:</label>
                        <select  class="form-select" id="size" name="size">
                            <option value="">- Lựa chọn -</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('admin/variant/'.$id)}}" class="btn btn-outline-secondary" style="margin-right: 10px;"><i class="fa-solid fa-arrow-left"></i> Danh sách</a>
                <button type="submit" name="add" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Tạo mới</button>
            </div>
        </form>
    </div>
@endsection
