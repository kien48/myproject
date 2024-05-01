<!DOCTYPE html>
<html lang="en"
@php
if(isset($_SESSION['darkMode'])){
    echo 'data-bs-theme="dark"';
}else{
    echo "";
}
 @endphp
>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include("layout.style")

</head>

<body>
<div class="loading-overlay">
    <div class="loading-spinner"></div>
</div>

<header >

    <nav class="navbar navbar-expand-sm bg-warning shadow" >

        <div class="container-fluid bg-warning ">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item d-flex " >
                   <h3>Trang quản trị</h3>
                </li>
            </ul>
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin/list-conversation')}}"><i class="fa-solid fa-message"></i>@if(isset($_SESSION['$dem'])){{ count($_SESSION['$dem']) }}@else{{ 0 }}@endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Xin chào {{$_SESSION['admin']->username}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('bạn muốn dăng xuất à?')" href="{{route('admin/logout')}}"><i class="fa-solid fa-right-from-bracket" data-bs-toggle="tooltip" title="Đăng xuất"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="d-flex sticky-top " >
    <div style="width: 200px;height: calc(100vh - 60px);" class="bg-light nav-left ">
        <ul class="nav flex-column">
            <li class="nav-item ni mt-2">
                <a class="nav-link" href="{{route('admin/')}}"><i class="fa-solid fa-house"></i>  Trang chủ</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="{{route('admin/category')}}"> <i class="fa-solid fa-layer-group"></i>  Danh mục</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="{{ route('admin/list-product/1') }}"><i class="fa-solid fa-shirt"></i>  Sản phẩm</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="{{ route('admin/order/1') }}"><i class="fa-solid fa-file-invoice-dollar"></i> Đơn hàng</a>
            </li>
            <li class="nav-item ni">
                <a class="nav-link" href="{{route('admin/list-discount/1')}}"><i class="fa-solid fa-diagram-predecessor"></i> Mã giảm giá</a>
            </li>
            <li class="nav-item ni ">
                <a class="nav-link" href="{{route('admin/users/1')}}"><i class="fa-solid fa-user"></i> Tài khoản</a>
            </li>
            <li class="nav-item ni ">
                <a class="nav-link" href="{{route('admin/comment/1')}}"><i class="fa-solid fa-message"></i> Bình luận</a>
            </li>
            <li class="nav-item ni ">
                <a class="nav-link" href="{{route('admin/post/list/1')}}"><i class="fa-solid fa-blog"></i> Bài viết</a>
            </li>
            <li class="nav-item ni ">
                <a class="nav-link" href="{{route('admin/settings')}}"><i class="fa-solid fa-gear"></i> Cài đặt</a>
            </li>
            <li class="nav-item ni ">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-circle-half-stroke"></i>
                       Chế độ màu
                </a>
            </li>
        </ul>
    </div>
    <div style="width: calc(100% - 200px);">
        <section class="content">
            @yield("content")
        </section>

    </div>


</main>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center">Chuyển sang giao diện tối</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('admin/darkMode') }}" method="post">
                    @csrf
                    <div class="form-check form-switch d-flex justify-content-around">
                        <label class="form-check-label" for="mySwitch">Tắt</label>
                        <input class="form-check-input" type="checkbox" id="mySwitch" name="darkmode" {{ isset($_SESSION['darkMode']) && $_SESSION['darkMode'] == 'on' ? 'checked' : '' }}>
                        <label class="form-check-label" for="mySwitch">Bật</label>
                    </div>


            </div>

            <!-- Modal footer -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Đồng ý</button>
            </div>
            </form>
        </div>
    </div>
</div>




@extends("layout.js")
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
</body>
</html>




