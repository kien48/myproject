@extends('layout.main')

@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý bình luận</h3>
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
                    <th>Tên người dùng</th>
                    <th>Nội dung</th>
                    <th>Sản phẩm</th>
                    <th>Thời gian</th>
                    <th>Sao</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $value)
                    <tr>
                        <th>{{$value->id}}</th>
                        <td>{{$value->username}}</td>
                        <td><p data-bs-toggle="tooltip" title="{{$value->content}}!">{{$value->content}}</p></td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>@if($value->star != 0)
                                {{$value->star}} <i class="fa-solid fa-star"></i>
                            @endif</td>

                        <td class="text-nowrap" style="width: 1px;">
                            <a href="{{route('admin/comment/feedback/'.$value->id)}}"><button class="btn btn-outline-warning"><i class="fa-brands fa-rocketchat"></i> Phản hồi</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <nav aria-label="...">
                        <ul class="pagination">
                            @if ($number > 1)
                                <li class="page-item"><a class="page-link" href="{{ route('admin/comment/'.($number - 1)) }}">Lùi</a></li>
                            @endif

                            @for($i = 1; $i <= $sotrang; $i++) <li class="page-item {{ ($number ?? 1) == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('admin/comment/'.$i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($number < $sotrang) <li class="page-item"><a class="page-link" href="{{ route('admin/comment/'.($number + 1)) }}">Tiến</a></li>
                            @endif
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection
