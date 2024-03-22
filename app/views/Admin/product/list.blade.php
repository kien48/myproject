@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý sản phẩm</h3>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('admin/form-add')}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới sản phẩm</a>
        </div>
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
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $pro )
                    <tr>
                        <th>{{$pro->id}}</th>
                        <td>{{$pro->name}}</td>
                        <td>{{number_format($pro->price)}} đ</td>
                        <td class="text-nowrap" style="width: 1px;">
                            <div style="width: 40px;height: 40px;" class="border rounded bg-light d-flex justify-content-center align-items-center">
                                <img src="../{{$pro->image}}" alt="" class="mh-100 mw-100 " >
                            </div>
                        </td>
                        <td>{{$pro->id_ct}}</td>
                        <td class="text-nowrap" style="width: 1px;">
                            <a href="detail.html"><button class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i> Chi
                                    tiết</button></a>
                            <a href="update.html"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Sửa</button></a>
                            <a onclick="return confirm('xóa nhé')" class="btn btn-outline-danger" href="{{route('admin/delete-product/'.$pro->id)}}">
                                       <i class="fa-solid fa-trash"></i> Xóa
                            </a>
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
