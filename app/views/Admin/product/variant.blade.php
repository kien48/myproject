@extends('layout.main')
@section("content")
    <div class="container mt-3">
        <h3 class="text-center">Quản lý biến thể sản phẩm</h3>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('admin/variant-add/'.$id)}}" class="btn btn-outline-success "><i class="fa-solid fa-plus"></i> Thêm mới biến thể sản phẩm</a>
        </div>
        @if(isset($_SESSION['success']) && isset($_GET['msg']))
            <div class="alert alert-success" role="alert">
                <span>{{$_SESSION['success']}}</span>
            </div>
    @endif
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>ID sản phẩm</th>
                    <th>Màu</th>
                    <th>Kích cỡ</th>
                    <th>Số lượng</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $key = 1 @endphp
                @foreach($list as $v )
                    <tr>
                        <th>{{$key++}}</th>
                        <td>{{$v->name}}</td>
                        <td>{{$v->idpro}}</td>
                        <td>{{$v->color}}</td>
                        <td>{{$v->size}}</td>
                        <td>{{$v->quantity}}</td>
                        <td class="text-nowrap" style="width: 1px;">
                            <div class="d-flex">
                                <a href="{{route('admin/variant-update/'.$v->id)}}"><button class="btn btn-outline-warning"><i class="fa-solid fa-wrench"></i> Cập nhật</button></a>
                                <form action="{{route('admin/variant/delete')}}" method="post">
                                    <input name="id_pro" type="hidden" value="{{$v->idpro}}">
                                    <input name="id" type="hidden" value="{{$v->id}}">
                                    <button onclick="return confirm('xóa nhé')"  class="btn btn-outline-danger ms-2" name="delete"> <i class="fa-solid fa-trash"></i> Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>


@endsection
