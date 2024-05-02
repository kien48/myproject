@extends("layout.main")
@section("content")
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">

            <h5 class="text-center mb-3 text-black-50">Chào mừng bạn đến với Yody!</h5>
            <div class="card-header d-flex justify-content-center bg-white">

                <h3 class="text-center" style="color: #002655;">ĐĂNG </h1>
                    <h3 class="text-center" style="color: #FFD700;">KÝ</h1>
            </div>

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
                <ul>
                    <li>{{$_SESSION['success']}}</li>
                </ul>
            </div>
            @endif
            <div class="card-body">
                <form method="post" action="{{route('register')}}">
                    <div class="form-group">
                        <label>Họ tên:</label>
                        <input type="text" class="form-control" placeholder="Nhập họ tên" name="name">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại:</label>
                        <input type="number" class="form-control" placeholder="Nhập Số điện thoại" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" placeholder="Nhập email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ:</label>
                        <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="pass">
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <a class="btn btn-warning text-white" href="{{route('form-login')}}" style="margin-right: 10px;">Đăng nhập</a>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Đăng Ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection