@extends("layout.main")
@section("content")
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                @if(isset($_SESSION['user']))
                    @if(isset($_SESSION['success']) && isset($_GET['msg']))
                        <div class="alert alert-success" role="alert">
                            <span>{{$_SESSION['success']}}</span>
                        </div>
                    @endif
                    Xin chào {{$_SESSION['user']->username}}
                    <a href="{{route("logout")}}" class="btn btn-secondary">Đăng xuất</a>
                @else
                    <div class="card-header d-flex justify-content-center bg-white">
                        <h3 class="text-center" style="color: #002655;">ĐĂNG </h1>
                            <h3 class="text-center" style="color: #FFD700;">NHẬP</h1>
                    </div>
                    @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                <li>{{$_SESSION['errors']}}</li>
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="post" action="{{route('login')}}">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" placeholder="Nhập email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="pass">
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a class="btn btn-warning text-white" href="dangky.html"
                                   style="margin-right: 10px;">Đăng ký</a>
                                <button type="submit" name="submit" class="btn btn-primary w-100">Đăng nhập</button>
                            </div>

                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
