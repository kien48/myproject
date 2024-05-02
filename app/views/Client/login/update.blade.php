@extends("layout.main")
@section("content")
<div class="container">
    <h2>Cập nhật thông tin tài khoản</h2>
    <form action="{{route('update')}}" method="POST">
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
            <label for="username">Tên người dùng:</label>
            <input type="text" class="form-control" id="username" name="username" value="{{$_SESSION['user']->username}}">
            <input type="hidden" class="form-control" name="id" value="{{$_SESSION['user']->id}}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$_SESSION['user']->email}}">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{$_SESSION['user']->phone}}">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" name="address" value="{{$_SESSION['user']->address}}">
            <button type="submit" class="btn btn-primary mt-4" name="submit">Cập nhật</button>
    </form>
</div>
@endsection