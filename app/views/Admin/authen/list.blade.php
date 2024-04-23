@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý tài khoản</h3>
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
                        <td class="text-nowrap" style="width: 1px;">
                            <a href="update.html"><button class="btn btn-outline-danger"><i class="fa-solid fa-ban"></i> Khóa tài khoản</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

