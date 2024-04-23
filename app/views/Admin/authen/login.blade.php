<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-info-subtle">
<div class="container-fluid mt-5 ">
    <div class="container d-flex justify-content-center" >
        <div class="row border rounded-2 bg-light-subtle" >
            <div class="col-6">
                <div class="d-flex justify-content-center" >
                    <img src="https://picsum.photos/200/300" alt="" height="500px" class="mw-100 mh-100 img-" style="margin-top: 10px;margin-bottom: 10px;margin-left: 0px">
                </div>
            </div>
            <div class="col-6">
                <h1 class="mt-3 h2 text-center">Chào mừng bạn trở lại </h1>
                @if(isset($_SESSION['errors']) && isset($_GET['msg']))
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($_SESSION['errors'] as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route("admin/check-login")}}" method="post">
                    <div class="mt-5">
                        <span>Tên đăng nhập</span>
                        <input type="text" name="user" class="form-control rounded-2" placeholder="Nhập tên đăng nhập vào đây!">
                    </div>
                    <div class="mt-3">
                        <span>Mật khẩu</span>
                        <input type="password" name="pass" class="form-control rounded-2" placeholder="Nhập mật khẩu đăng nhập vào đây!">
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="check" class="btn btn-primary w-100">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
