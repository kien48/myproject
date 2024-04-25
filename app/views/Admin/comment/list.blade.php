@extends('layout.main')

@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý bình luận</h3>
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
                        <td>{{$value->id_user}}</td>
                        <td><p data-bs-toggle="tooltip" title="{{$value->content}}!">{{$value->content}}</p></td>
                        <td>{{$value->id_pro}}</td>
                        <td>{{$value->created_at}}</td>
                        <td>{{$value->star}} <i class="fa-solid fa-star"></i></td>

                        <td class="text-nowrap" style="width: 1px;">
                            <a href="update.html"><button class="btn btn-outline-warning"><i class="fa-brands fa-rocketchat"></i> Phản hồi</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection
