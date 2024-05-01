@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý tài khoản</h3>
        @php
            // Lấy URL hiện tại từ biến siêu toàn cục $_SERVER['REQUEST_URI'] và lưu vào biến $url
            $url = $_SERVER['REQUEST_URI'];
            // Sử dụng hàm explode để tách chuỗi URL thành một mảng các phần tử dựa trên dấu gạch chéo ("/")
            $parts = explode("/", $url);
            // Lấy phần tử cuối cùng của mảng $parts, tức là phần cuối cùng trong đường dẫn URL
            $number = end($parts);
        @endphp
        @if(isset($_SESSION['errors']) && isset($_GET['msg']))
            <div class="alert alert-danger" role="alert">
                <span>{{$_SESSION['errors']}}</span>
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
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày tạo</th>
                    <th>Hạng</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $value)
                    <tr>
                        <th>{{$value->id}}</th>
                        <td>{{$value->username}}</td>
                        <td>{{($value->email)}}</td>
                        <td>{{$value->password}}</td>
                        <td>{{$value->phone}}</td>
                        <td>{{$value->address}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>{{$value->rank}}</td>
                        <td>{{$value->status}}</td>
                        <td class="text-nowrap" style="width: 1px;">
                            @if($value->status == 0)
                                    <a onclick="return confirm('Khóa nhá')" href="{{route('admin/users/lock/'.$value->id)}}"><button class="btn btn-outline-danger"><i class="fa-solid fa-ban"></i> Khóa tài khoản</button></a>
                                @else
                                <a  onclick="return confirm('Mở nhá')"   href="{{route('admin/users/mo/'.$value->id)}}"> <button class="btn btn-outline-warning"><i class="fa-solid fa-lock-open"></i> Mở lại khóa</button></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination">
                            @for($i = 1; $i <= $sotrang; $i++) <li class="page-item {{ ($number ?? 1) == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('admin/users/'.$i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($number < $sotrang) <li class="page-item"><a class="page-link" href="{{ route('admin/users/'.($number + 1)) }}">Tiến</a></li>
                            @endif
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

