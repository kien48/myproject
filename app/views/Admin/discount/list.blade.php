@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý mã giảm giá</h3>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('admin/discount/form-add')}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới mã giảm giá</a>
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
                    <th>Mã</th>
                    <th>Phần trăm giảm</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày hết hạn</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($list as $value )
                    <tr>
                        <th>{{$value->id}}</th>
                        <td>{{$value->code}}</td>
                        <td>{{$value->percent}}%</td>
                        <td>{{$value->start_day}}</td>
                        <td>{{$value->expiration}}</td>
                        <td>{{$value->quantity}}</td>
                        <td>{{$value->status}}</td>
                        <td class="text-nowrap" style="width: 1px;">
                            <a href="{{route('admin/discount/form-update/'.$value->id)}}"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Cập nhật</button></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <h6>* Mã sẽ tự động xóa sau khi hết hạn</h6>
            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                <ul class="pagination">
                        @if ($number > 1)
                        <li class="page-item"><a class="page-link" href="{{ route('admin/list-discount/'.($number - 1)) }}">Lùi</a></li>
                        @endif

                        @for($i = 1; $i <= $sotrang; $i++) <li class="page-item {{ ($number ?? 1) == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('admin/list-discount/'.$i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($number < $sotrang) <li class="page-item"><a class="page-link" href="{{ route('admin/list-discount/'.($number + 1)) }}">Tiến</a></li>
                                @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection