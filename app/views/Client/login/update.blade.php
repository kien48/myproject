@extends("layout.main")
@section("content")
<div class="container">
    <h2>Cập nhật thông tin tài khoản</h2>
    <form action="update_account.php" method="POST">
        <div class="form-group">
            <label for="username">Tên người dùng:</label>
            <input type="text" class="form-control" id="username" name="username" value="{{$_SESSION['user']->username}}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$_SESSION['user']->email}}">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$_SESSION['user']->phone}}">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" name="address" value="{{$_SESSION['user']->address}}">
        <button type="submit" class="btn btn-primary mt-4">Cập nhật</button>
    </form>
</div>
@endsection