@extends("layout.main")
@section("content")
    <div class="container">
        <h2>Cập nhật mật khẩu tài khoản</h2>
        <form action="{{route('update/pass')}}" method="POST">
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
            <div class="form-group">
                <label for="password">Mật khẩu hiện tại:</label>
                <input type="password" class="form-control" id="username" name="pass" >
                <input type="hidden" class="form-control" name="id" value="{{$_SESSION['user']->id}}">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu mới:</label>
                <input type="password" class="form-control"  name="pass_new" >
            </div>
                <div class="form-group">
                    <label for="password">Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control" name="pass_new_1" >
                </div>
                <button type="submit" class="btn btn-primary mt-4" name="submit">Cập nhật</button>
        </form>
    </div>
@endsection
