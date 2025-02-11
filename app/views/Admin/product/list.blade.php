@extends('layout.main')
@section("content")
<div class="container mt-3">
    <h3 class="text-center">Quản lý sản phẩm</h3>
    <div>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('admin/form-add')}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới sản phẩm</a>
        </div>
        <form class="d-flex" method="get" action="{{route('admin/list-product/1')}}">
            <input class="form-control me-2" type="text" placeholder="Tìm theo ID" name="id">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </form>
    </div>

    @if(isset($_SESSION['success']) && isset($_GET['msg']))
    <div class="alert alert-success" role="alert">
        <span>{{$_SESSION['success']}}</span>
    </div>

    @endif
    @php
    // Lấy URL hiện tại từ biến siêu toàn cục $_SERVER['REQUEST_URI'] và lưu vào biến $url
    $url = $_SERVER['REQUEST_URI'];
    // Sử dụng hàm explode để tách chuỗi URL thành một mảng các phần tử dựa trên dấu gạch chéo ("/")
    $parts = explode("/", $url);
    // Lấy phần tử cuối cùng của mảng $parts, tức là phần cuối cùng trong đường dẫn URL
    $number = end($parts);
    @endphp
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Nhập</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Biến thể</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($products as $pro )
                <tr>
                    <th>{{$pro->id}}</th>
                    <td>{{$pro->name}}</td>
                    <td>{{number_format($pro->import_price)}} đ</td>
                    <td>{{number_format($pro->price)}} đ</td>
                    <td class="text-nowrap" style="width: 1px;">
                        <div style="width: 40px;height: 40px;" class="border rounded bg-light d-flex justify-content-center align-items-center">
                            <img src="../../{{$pro->image}}" alt="" class="mh-100 mw-100 ">
                        </div>
                    </td>
                    <td>{{$pro->name_ct}}</td>
                    <td>{{$pro->status}}</td>
                    <td class="text-nowrap" style="width: 1px;">
                        <a href="{{route("admin/variant/".$pro->id)}}"><button class="btn btn-outline-secondary"><i class="fa-solid fa-viruses"></i> Biến thể</button></a>
                        <a href="{{route('admin/product/form-update/'.$pro->id)}}"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Cập nhật</button></a>
                        <a onclick="return confirm('xóa nhé')" class="btn btn-outline-danger" href="{{route('admin/delete-product/'.$pro->id)}}">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <h6>* Nếu không có biến thể thì sản phẩm sẽ không được hiện trên màn hình client</h6>
        @if(!isset($_GET['id']))
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination">
                            @if ($number > 1)
                                <li class="page-item"><a class="page-link" href="{{ route('admin/list-product/'.($number - 1)) }}">Lùi</a></li>
                            @endif

                            @for($i = 1; $i <= $sotrang; $i++) <li class="page-item {{ ($number ?? 1) == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('admin/list-product/'.$i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($number < $sotrang) <li class="page-item"><a class="page-link" href="{{ route('admin/list-product/'.($number + 1)) }}">Tiến</a></li>
                            @endif
                        </ul>

                    </nav>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection