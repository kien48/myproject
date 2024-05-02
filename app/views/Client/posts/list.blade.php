@extends("layout.main")
@section("content")
<div class="container mt-3">
    <!-- Page Heading -->
    <h3 class="text-center mb-3">Danh sách bài viết</h3>
    <div class="row">
        @foreach($listAll as $post)
        <div class="col-md-3 mt-3">
            <div class="card" style="width:300px">
                <a href="{{route('post/detail/'.$post->id)}}" class="nav-link">
                    <img class="card-img-top" src="../public/img/{{$post->image}}" alt="Card image" height="195px">
                    <div class="card-body">
                        <div style="height: 120px">
                            <h4 class="card-title">{{$post->tilte}}</h4>
                        </div>
                </a>
                <p class="card-text">Tác giả: {{$post->author}}</p>
                <h8>Ngày đăng : {{$post->date}}</h8>
                <div class="text-center mt-2">
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @php
    // Lấy URL hiện tại từ biến siêu toàn cục $_SERVER['REQUEST_URI'] và lưu vào biến $url
    $url = $_SERVER['REQUEST_URI'];
    // Sử dụng hàm explode để tách chuỗi URL thành một mảng các phần tử dựa trên dấu gạch chéo ("/")
    $parts = explode("/", $url);
    // Lấy phần tử cuối cùng của mảng $parts, tức là phần cuối cùng trong đường dẫn URL
    $number = end($parts);
    @endphp
    <div class="d-flex justify-content-center mt-5">
        <div class="d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                    @if ($number > 1)
                    <li class="page-item"><a class="page-link" href="{{ route('admin/post/list/'.($number - 1)) }}">Lùi</a></li>
                    @endif

                    @for($i = 1; $i <= $soTrang; $i++) <li class="page-item {{ ($number ?? 1) == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('admin/post/list/'.$i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        @if ($number < $soTrang) <li class="page-item"><a class="page-link" href="{{ route('admin/post/list/'.($number + 1)) }}">Tiến</a></li>
                            @endif
                </ul>

            </nav>
        </div>
    </div>

</div>
@endsection