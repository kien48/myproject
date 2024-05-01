@extends("layout.main")
@section('content')
<div class="container mt-3">
    <!-- Page Heading -->
    <h3 class="text-center mb-3">Trang cài đặt</h3>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="height: 500px; overflow-y: auto;">
        <div class="card-body">
            <form action="{{route('admin/settings/update')}}" method="POST">
                <table class="table">
                    <tr>
                        <th>Trường dữ liệu</th>
                        <th>Dữ liệu</th>
                    </tr>

                    <tr>
                        <td>Logo</td>
                        <td>
                            <input type="text" class="form-control" name="logo" value="{{$_SESSION['listSettings'][0]->logo}}">
                            <div class="border text-center " style="height: 70px">
                                <img src="{{$_SESSION['listSettings'][0]->logo}}" alt="" height="50px" class="mt-2">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Banner 1</td>
                        <td>
                            <input type="text" class="form-control" name="banner1" value="{{$_SESSION['listSettings'][0]->banner1}}">
                            <div class="border text-center " style="height: 70px">
                                <img src="{{$_SESSION['listSettings'][0]->banner1}}" alt="" height="50px" class="mt-2">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Link banner 1 (lấy ID bài viết)</td>
                        <td>
                            <input type="text" class="form-control" name="link_bn_1" value="{{$_SESSION['listSettings'][0]->link_bn_1}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Banner 2</td>
                        <td>
                            <input type="text" class="form-control" name="banner2" value="{{$_SESSION['listSettings'][0]->banner2}}">
                            <div class="border text-center " style="height: 70px">
                                <img src="{{$_SESSION['listSettings'][0]->banner2}}" alt="" height="50px" class="mt-2">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Link banner 2 (lấy ID bài viết)</td>
                        <td>
                            <input type="text" class="form-control" name="link_bn_2" value="{{$_SESSION['listSettings'][0]->link_bn_2}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Banner 3</td>
                        <td>
                            <input type="text" class="form-control" name="banner3" value="{{$_SESSION['listSettings'][0]->banner3}}">
                            <div class="border text-center " style="height: 70px">
                                <img src="{{$_SESSION['listSettings'][0]->banner3}}" alt="" height="50px" class="mt-2">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Link banner 3 (lấy ID bài viết)</td>
                        <td>
                            <input type="text" class="form-control" name="link_bn_3" value="{{$_SESSION['listSettings'][0]->link_bn_3}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Câu nói</td>
                        <td>
                            <textarea type="text" class="form-control" name="sayings" >{{$_SESSION['listSettings'][0]->sayings}}</textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Link Facebook</td>
                        <td>
                            <input type="text" class="form-control" name="link_fb" value="{{$_SESSION['listSettings'][0]->link_fb}}">
                        </td>
                    </tr>

                    <tr>
                        <td>Link Youtube</td>
                        <td>
                            <input type="text" class="form-control" name="link_yt" value="{{$_SESSION['listSettings'][0]->link_yt}}">
                        </td>
                    </tr>

                    <tr>
                        <td>Link Tiktok</td>
                        <td>
                            <input type="text" class="form-control" name="link_tiktok" value="{{$_SESSION['listSettings'][0]->link_tiktok}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Banner</td>
                        <td>
                            <input type="text" class="form-control" name="banner" value="{{$_SESSION['listSettings'][0]->banner}}">
                            <div class="border text-center " style="height: 160px">
                                <img src="{{$_SESSION['listSettings'][0]->banner}}" alt="" height="140px" class="mt-2">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tên công ty</td>
                        <td>
                            <input type="text" class="form-control" name="company_name" value="{{$_SESSION['listSettings'][0]->company_name}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>
                            <input type="number" class="form-control" name="phone" value="{{$_SESSION['listSettings'][0]->phone}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>
                            <textarea type="text" class="form-control" name="address" >{{$_SESSION['listSettings'][0]->address}}</textarea>
                        </td>
                    </tr>

                </table>

                <button type="submit" name="update" class="btn btn-success">Lưu</button>
            </form>
        </div>
    </div>
</div>

@endsection
